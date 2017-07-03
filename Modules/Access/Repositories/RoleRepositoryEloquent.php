<?php

namespace Modules\Access\Repositories;

use Modules\Access\Entities\Permission;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Access\Contracts\RoleRepository;
use Modules\Access\Entities\Role;
use Modules\Access\Validators\RoleValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return RoleValidator::class;
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

        $this->model->name = ucfirst($attributes['name']);
        $this->model->display_name = ($attributes['display_name']);
        $this->model->description = $attributes['description'];

        if($this->model->save()){
            return $this->model;
        }else{
            throw new \Exception("Erro ao gravar registro no banco!");
        }
    }
    public function update(array $attributes, $id)
    {
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();
            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }

        $model = $this->model->findOrFail($id);
        $model->perms()->sync([]);
        if($attributes['checked']){
            $allPerms = Permission::all();
            foreach ($allPerms as $perm){
                $model->attachPermission($perm);
            }
        }else{
            $model->perms()->sync($attributes['perms']);
        }
        unset($attributes['checked']);
        unset($attributes['perms']);
//        $model->fill($attributes);
        $model->save();
        return $model;
//        return $this->parserResult($model);
    }
}
