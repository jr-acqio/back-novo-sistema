<?php

namespace Modules\Boletos\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Boletos\Contracts\BoletoRepository;
use Modules\Boletos\Entities\Boleto;

/**
 * Class BoletoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BoletoRepositoryEloquent extends BaseRepository implements BoletoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Boleto::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}
