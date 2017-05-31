<?php

namespace Modules\Boletos\Repositories;

use Mockery\Exception;
use Modules\Boletos\Validators\ConciliationValidator;
use Modules\Boletos\Contracts\ConcilationRepository;
use Modules\Boletos\Entities\Boleto;
use OwenIt\Auditing\Drivers\Database;
use OwenIt\Auditing\Events\Auditing;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Boletos\Entities\Concilation;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use DB;
/**
 * Class ConcilationRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ConcilationRepositoryEloquent extends BaseRepository implements ConcilationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Concilation::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return ConciliationValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        $path = $attributes['arquivo']->storeAs(
            'boletos/retorno', $attributes['arquivo']->getClientOriginalName()
        );
        $attributes += array('file_path'=>$path);

        unset($attributes['arquivo']);
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
        $model = $this->model->newInstance();
        $model->payload = $attributes['payload'];
        $model->file_path = $attributes['file_path'];
        $model->save();
        event(new Auditing($model,new Database));
        $this->resetModel();

        return $this->parserResult($model);
    }

    public function processReturn(array $attributes)
    {
#Definindo conteúdo da requisição e tipos de respostas aceitas
        $accept_header = array('Accept: application/json','Content-Type: multipart/form-data');

#Estou enviando esse formato de dados
        $headers = $accept_header;

#Configurações do envio
        if(config('app.env') == 'local'){
            $url = 'https://sandbox.boletocloud.com/api/v1/arquivos/cnab/retornos';
            $api_key = 'api-key_W1J1KwcnNor-4VHP58KLuXv8UcKqIY31p8AwIuXPw1s=';
        }else{
            $url = 'https://app.boletocloud.com/api/v1/arquivos/cnab/retornos';
            $api_key = 'api-key_4EdpeTuf5MwzipcmXYTmCdv5wqYLRCgT3shDb41Pzu4=';
        }

        $data_create = array(
            'arquivo' => $attributes['file'],
        );
        $data = array(
            'arquivo' => new \CURLFile($attributes['file']),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, $api_key); #API TOKEN
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);# Basic Authorization
        curl_setopt($ch, CURLOPT_HEADER, true);#Define que os headers estarão na resposta
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); #Para uso com https
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); #Para uso com https

        #Envio

        $response = curl_exec($ch);

        #Principais meta-dados da resposta

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        #Fechar processo de comunicação
        curl_close($ch);

        #Processando a resposta

        $created = 201; #Constante que indica recurso criado (Retorno criado na Plataforma)

        #Separando header e body na resposta

        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $header_array = explode("\r\n", $header);

        #Principais headers
        $boleto_cloud_version = '';
        $boleto_cloud_token = '';
        $location = '';

        foreach($header_array as $h) {
            if(preg_match('/X-BoletoCloud-Version:/i', $h)) {
                $boleto_cloud_version = $h;
            }
            if(preg_match('/X-BoletoCloud-Token:/i', $h)) {
                $boleto_cloud_token = $h;
            }
            if(preg_match('/Location:/i', $h)) {
                $location = $h;
            }
        }
        #Processando sucesso ou falha
        if($http_code == $created){
            #Versão da plataforma: $boleto_cloud_version
            #Token do boleto disponibilizado: $boleto_cloud_token
            #Localização do boleto na plataforma: $location
            #Enviando boleto como resposta:
            header('Content-Type: application/json; charset=utf-8');
            $data_create += array('payload'=>json_decode($body,true));
            try{
                if(!$this->verifyConciliation($data_create['payload']['arquivo']['meta']['token'])){
                    DB::beginTransaction();
                    $titulos_pagos = $this->conciliation($body);
                    if($this->create($data_create)){
                        DB::commit();
                        return response()->json([
                            'msg'=>'Arquivo processado com sucesso!',
                            'info' => $titulos_pagos
                        ],200);
                    }
                }else{
                    throw new Exception("Arquivo já processado!");
                }
            }catch(ValidatorException $exception){
                DB::rollBack();
                throw new ValidatorException($exception->getMessageBag());
            }
            catch(Exception $exception){
                DB::rollBack();
                throw new Exception($exception->getMessage());
            }
        }else{
#EM CASO DE ERRO 500 ---> LEMBRE-SE QUE É PRECISO TER UMA CONTA BANCÁRIA CADASTRADA!!
#E COM CONVÊNIO E DADOS IGUAIS AO DA CONTA BANCÁRIA DO ARQUIVO RELACIONADO
            #Versão da plataforma: $boleto_cloud_version
            #Códgio de erro HTTP: $http_code
            #Enviando erro como resposta:
            header('Content-Type: application/json; charset=utf-8');
            throw new Exception($body);
//            return $body; #Visualização no navegador
        }
    }

    private function conciliation($response)
    {
        $data = json_decode($response,true);
        $titulos = $data['arquivo']['titulos'];
        $titulos_pagos = array();
        foreach ($titulos as $k => $v){
            //Se o boleto ainda existir no banco
            if($current = Boleto::where('token',$v['token'])->first()){
                $ocorrencias = $v['ocorrencias'];
                foreach ($ocorrencias as $k2 => $v2){
                    if($v2['situacao'] == 'LIQUIDACAO'){
                        $current->situacao = 1;
                        $current->save();
                        array_push($titulos_pagos, $current);
                        event(new Auditing($current,new Database));
                    }
                }
            }
        }
        return $titulos_pagos;
    }
    private function verifyConciliation($criteria){
        return $this->findByField('payload->arquivo->meta->token',$criteria)->count();
    }
}
