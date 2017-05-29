<?php

namespace Modules\Access\Repositories;

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
            return $this->model;
        }else{
            throw new Exception("Erro ao gravar registro no banco!");
        }
    }
    public function update(array $attributes, $id)
    {
        $this->applyScope();

//        if (!is_null($this->validator)) {
//            // we should pass data that has been casts by the model
//            // to make sure data type are same because validator may need to use
//            // this data to compare with data that fetch from database.
//            $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();
//
//            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
//        }

//        if ($this->model->where('email','joselito.junior@esfera5.com.br')->where('id','<>',$id)->get()->count() >= 1){
//            throw new Exception('Usuário '. $attributes['email'].' já cadastrado no Sistema');
//        }

        $attributes['password'] = bcrypt('123456');
        $model = $this->model->findOrFail($id);
//        $model->name = $attributes['name'];
        $model->password = $attributes['password'];
//        dd($model);
//        $model->email = $attributes['email'];

//        $model->fill($attributes);
        $model->save();
        return $model;
//        $this->resetModel();

//        return $this->parserResult($model);
    }

    private function verifyUser(array $attributes){
        $user = $this->model->query()
            ->where('email',$attributes['email'])
            ->count();

        return $user;
    }

}
