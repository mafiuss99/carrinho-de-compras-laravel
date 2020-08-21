<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    protected $fillable = [
        'logo',
        'nome',
        'descricao'
    ];
}
