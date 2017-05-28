<?php

namespace Modules\Boletos\Entities;

use Illuminate\Database\Eloquent\Model;

class BoletoProdutos extends Model
{
    protected $fillable = [];
    protected $connection = "mysql_boletos";

    protected $table = "boleto_produtos";

    public function produto(){
    	return $this->belongsTo(Produto::class,'idproduto');
    }
}
