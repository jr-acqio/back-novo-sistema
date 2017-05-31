<?php

namespace Modules\Boletos\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Concilation extends Model implements Transformable, AuditableContract
{
    use TransformableTrait, Auditable;

    protected $connection = 'mysql_boletos';

    protected $fillable = [
        'payload',
        'file_path'
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function resolveUserId()
    {
        return request()->user() ? request()->user()->id : null;
    }
}
