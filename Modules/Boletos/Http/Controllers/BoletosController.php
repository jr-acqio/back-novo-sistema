<?php

namespace Modules\Boletos\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BoletosController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('boletos::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('boletos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    public function conciliation(Request $request)
    {
        $this->validate($request,
            [
                'file' => 'required|mimetypes:text/plain'
            ],
            [
                'file.required'=>'Informe o arquivo a ser processado!',
                'file.mimetypes' => 'Informe um arquivo válido!'
            ]);
#Definindo conteúdo da requisição e tipos de respostas aceitas
        $accept_header = array('Accept: application/json','Content-Type: multipart/form-data');

#Estou enviando esse formato de dados
        $headers = $accept_header;

#Configurações do envio

        $url = 'https://sandbox.boletocloud.com/api/v1/arquivos/cnab/retornos';

        $data = array(
            'arquivo' => new \CURLFile($request->file),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, "api-key_W1J1KwcnNor-4VHP58KLuXv8UcKqIY31p8AwIuXPw1s="); #API TOKEN
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
            return $body; #Visualização no navegador
        }else{
#EM CASO DE ERRO 500 ---> LEMBRE-SE QUE É PRECISO TER UMA CONTA BANCÁRIA CADASTRADA!!
#E COM CONVÊNIO E DADOS IGUAIS AO DA CONTA BANCÁRIA DO ARQUIVO RELACIONADO
            #Versão da plataforma: $boleto_cloud_version
            #Códgio de erro HTTP: $http_code
            #Enviando erro como resposta:
            header('Content-Type: application/json; charset=utf-8');
            return $body; #Visualização no navegador
        }

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('boletos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('boletos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
