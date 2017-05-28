<?php

namespace Modules\Boletos\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Boleto extends Model implements Transformable
{
    use TransformableTrait;

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

}
