<?php

namespace Modules\Access\Repositories;

use Modules\Access\Validators\PermissionValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Access\Contracts\PermissionRepository;
use Modules\Access\Entities\Permission;
use Prettus\Validator\Contracts\ValidatorInterface;

//use App\Validators\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    public function validator()
    {
        return PermissionValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
//            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $this->model->name = $attributes['name'];
        $this->model->display_name = ($attributes['display_name']);
        $this->model->description = $attributes['description'];

        if($this->model->save()){
            return $this->model;
        }else{
            throw new \Exception("Erro ao gravar registro no banco!");
        }
    }
}
