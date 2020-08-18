<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];
    
    public function pedido_produto()
    {
        /*Relacionamento do tipo 1 pra N, no caso existe 1 pedido e vários predido produto*/
        return $this->hasMany('App\PedidoProduto')
            ->select(\DB::raw('produto_id, sum(desconto) as descontos, sum(valor) as valores, count(1) as qtd'))
            ->groupBy('produto_id')
            ->orderBy('produto_id', 'desc');
    }

    public function pedido_produtos_itens()
    {
        /* Temos um pedido para vários pedido_produto*/
        return $this->hasMany('App\PedidoProduto');
    }

    //Consulta um registro de Pedido através dos dados passados
    public static function consultaId($where){
        //pesquisando o primeiro pedido do array que tiver os valores informados
        $pedido = self::where($where)->first(['id']);

        //retornando caso o id do pedido for vazio, o proprio id, senão null
        return !empty($pedido->id) ? $pedido->id : null;
    }
}
