<?php

namespace Modules\Boletos\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Boleto extends Model implements Transformable, AuditableContract
{
    use TransformableTrait, Auditable;

    protected $connection = "mysql_boletos";

    protected $fillable = [];

    protected $guarded = array();

    protected $table = 'boleto_solicitado';

    public function cliente(){
        return $this->hasOne(BoletoSolicitadoCliente::class,'idboleto_solicitado');
    }
    public function franchising(){
        return $this->hasOne(BoletoSolicitadoFranchising::class,'idboleto_solicitado');
    }

    public function resolveUserId()
    {
        return request()->user() ? request()->user()->id : null;
    }
}
