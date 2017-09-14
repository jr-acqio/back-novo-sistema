<?php

namespace Modules\Access\Repositories;

use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Modules\Access\Contracts\UserRepository;
use OwenIt\Auditing\Events\Auditing;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Access\Entities\User;
use Modules\Access\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return UserValidator::class;
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

        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
//            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
        if ($this->verifyUser($attributes) >= 1){
            throw new Exception('Usuário '. $attributes['email'].' já cadastrado no Sistema');
        }

        $this->model->name = ucfirst($attributes['name']);
        $this->model->password = bcrypt($attributes['password']);
        $this->model->email = $attributes['email'];

        if($this->model->save()){
            //Adicionando novas Roles no usuario
            foreach($attributes['roles'] as $r){
                $this->model->attachRole($r);
            }
            return $this->model;
        }else{
            throw new Exception("Erro ao gravar registro no banco!");
        }
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();

            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }

        if ($this->model->withTrashed()->where('email',$attributes['email'])->where('id','<>',$id)->get()->count() >= 1){
            throw new Exception('Usuário '. $attributes['email'].' já cadastrado no Sistema');
        }
        $model = $this->model->withTrashed()->findOrFail($id);
        // Se tiver desativado, restaura para fazer a atualização
        if($model->deleted_at != null) {
            $model->restore();
        }
        $attributes['password'] = bcrypt($attributes['password']);

        unset($attributes['password_confirmation']);
        $model->fill($attributes);
        $model->save();

        //Inserindo novas Roles
        if(count($attributes['roles'])) {
            //Removendo as roles do user
            $model->roles()->sync([]);
            foreach($attributes['roles'] as $r){
                $model->attachRole($r);
            }
        }
        // Se usuário ativo for diferente de true ele inativa o usuário novamente
        if(!$attributes['active']) {
            $model->delete();
        }
        return $model;
    }

    private function verifyUser(array $attributes){
        $user = $this->model->query()
            ->where('email',$attributes['email'])
            ->count();

        return $user;
    }

    public function enabledUser($id)
    {
        try{
            $user = $this->model->withTrashed()->findOrFail($id);
            $user->restore();
            return $user;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function disabledUser($user){
        $user->delete();
        return $user;
    }
}
