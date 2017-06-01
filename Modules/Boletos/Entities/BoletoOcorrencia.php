<?php

namespace Modules\Boletos\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BoletoOcorrencia extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'situacao',
        'data',
        'descricao',
        'motivos',
        'info',
    ];
    protected $connection = "mysql_boletos";
    protected $casts = [
        'motivos'=> 'array',
        'info'   => 'array',
    ];

    public function boleto(){
        return $this->belongsTo(Boleto::class);
    }
}
