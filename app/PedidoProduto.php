<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $fillable = [
        'pedido_id',
        'produto_id',
        'status',
        'valor'
    ];
    public function produto()
    {
        /* Utilizado para o relacionamento da Foreign Key com a Primary key */
            return $this->belongsTo('App\Produto', 'produto_id', 'id');
    }
}
