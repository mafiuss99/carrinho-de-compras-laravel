<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Estudio;


class Produto extends Model
{
    protected $fillable = [
        'titulo',
        'sinopse',
        'capa',
        'trailer',
        'valor',
        'classificacao',
        'ativo',
        'destaque',
        'estudio_id',
        'ano',
        'lancamento'
    ];
    public function estudio()
    {
        return $this->hasOne('App\Estudio', 'estudio_id', 'id');
    }
}
