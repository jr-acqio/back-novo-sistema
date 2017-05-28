<?php

namespace Modules\Boletos\Entities;

use Illuminate\Database\Eloquent\Model;

class BoletoSolicitadoUpgrade extends Model
{
    protected $fillable = [];
    protected $connection = "mysql_boletos";
    protected $table = "boleto_solicitado_upgrade";
    public $timestamps = false;
}
