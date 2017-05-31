<?php

namespace Modules\Boletos\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ConcilationRepository
 * @package namespace App\Repositories;
 */
interface ConcilationRepository extends RepositoryInterface
{
    public function processReturn(array $attributes);
}
