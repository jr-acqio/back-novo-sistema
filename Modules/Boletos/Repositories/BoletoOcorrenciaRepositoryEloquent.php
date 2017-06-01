<?php

namespace Modules\Boletos\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Boletos\Repositories\BoletoOcorrenciaRepository;
use Modules\Boletos\Entities\BoletoOcorrencia;

/**
 * Class BoletoOcorrenciaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BoletoOcorrenciaRepositoryEloquent extends BaseRepository implements BoletoOcorrenciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BoletoOcorrencia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
