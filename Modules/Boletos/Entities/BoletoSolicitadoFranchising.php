<?php

namespace Modules\Boletos\Entities;

use Illuminate\Database\Eloquent\Model;

class BoletoSolicitadoFranchising extends Model
{
    protected $fillable = [];
    protected $connection = "mysql_boletos";
    protected $table = "boleto_solicitado_franchising";


    public function fda(){
    	return $this->belongsTo(Fda::class,'idfda');
    }

    public function produtos(){
        // Model Class, foreign key, primary key do Model Class
        return $this->hasMany(BoletoProdutos::class, 'idboleto_solicitado','idboleto_solicitado');
    }
}
