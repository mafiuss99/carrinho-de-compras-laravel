<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;
use App\Cupomdesconto;


class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __contruct()
    {
        //obirgatorio estar logado
        $this->middleware('auth');
    }
    
    public function index()
    {
        //Salva em uma variável o resultado da query na tabela de Pedido, que tenha status igual a 'RE' e o user_id igual ao do usuário logado
        $pedidos = Pedido::where([
            'status' => 'RE',
            'user_id' => Auth::id()
        ])->get();
        //Uma função get para retornar o valor
        
        //Retorna a view passando por parâmetro a variável Pedidos
        return view('carrinho.index', compact('pedidos'));

    }

    //Função para adicionar um novo registro ao carrinho, seja de um novo pedido, quanto de um produto
    public function store()
    {
        //Verfica se a requisição tem o token
        $this->middleware('VerifyCsrfToken');

        //Instancia a classe request
        $req = Request();

        /**
         * VALIDANDO SE O PRODUTO EXISTE NA LOJA
         */
        //informa que a variável $idproduto é igual ao valor do input 'id' vindo da requisição
        $idproduto = $req->input('id');

        //salva na variável $produto o valor da consulta pelo metodo find da classe Produto, pode retornar Null ou não
        $produto = Produto::find($idproduto);

        //Neste if foi pego a variável $produto->id e verificou se ela está vazia, se estiver, redirecione para a página principal do carrinho, com uma mensagem de falha
        if(empty($produto->id)){
            $req->session()->flash('mensagem-falha', 'Produto não encontrado em nossa loja!');
            return redirect()->route('carrinho.index');
        }

        /**
         * VERIFICANDO SE EXISTE ALGUM PEDIDO ATIVO PARA ESTE USUÁRIO
         */

        //Salvando o id do usuário em uma variável
        $idusuario = Auth::id();

        //Consultando se o pedido com o id do usuário e com o status RE existe
        $idpedido = Pedido::consultaId([
            'user_id' => $idusuario,
            'status' => 'RE'
        ]);

        //Verificando se a consulta anterior está vazia, caso esteja, será criando um novo registro na tabela de pedido, com o usaer_id do usua´rio logado eo status reservado
        if (empty($idpedido)){
            $pedido_novo = Pedido::create([
                'user_id' => $idusuario,
                'status' => 'RE'
            ]);
            //Atribuindo o valor do registro criado a variável idpedido
            $idpedido = $pedido_novo->id;
        }

        //Criando um novo registro na tabela PedidoProduto, com o id do pedido e id do produto, com o valor do produto e status Reservado
        PedidoProduto::create([
            'pedido_id' => $idpedido,
            'produto_id' => $idproduto,
            'valor' => $produto->valor,
            'status' => 'RE'
        ]);
        
        //Retornando uma view com a mensagem de sucesso
        $req->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('carrinho.index');
    }

    //
    public function destroy(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

        $idpedido = $request->input('pedido_id');
        $idproduto = $request->input('produto_id');

        //Quando o booleando for true irá remover apenas 1 item do carrinho, quando for false, remove todos
        $remove_apenas_item = (boolean)$request->input('item');
        
        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'id'  => $idpedido,
            'user_id' => $idusuario,
            'status' => 'RE'
        ]);

        if(empty($idpedido)){
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado');
            return redirect()->route('carrinho.index');
        }

        $where_produto = [
            'pedido_id' => $idpedido,
            'produto_id' => $idproduto
        ];

        $produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if(empty($produto->id)){
            $request->session()->flash('mensagem-falha', 'Produto não encontrado no carrinho!');
            return redirect()->route('carrinho.index');
        }

        if($remove_apenas_item){
            $where_produto['id'] = $produto->id;
        }
        PedidoProduto::where($where_produto)->delete();

        /* Verificando se existe mais um item para retornar um booleano*/
        $check_pedido = PedidoProduto::where([
            'pedido_id' => $produto->pedido_id
        ])->exists();

        if(!$check_pedido){
            Pedido::where([
                'id' => $produto->pedido_id
            ])->delete();
        }

        $request->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function concluir(Request $request){
        //Verifica se foi enviado o Token na requisição
        $this->middleware('VerifyCsrfToken');
        //Salva em uma variável o valor do input de name 'pedido_id'
        $idpedido = $request->input('pedido_id');
        //Salva em uma variável o valor do id do usuário logado
        $idusuario = Auth::id();
        
        /***
         * VALIDAÇÕES
         */
        
        //Verifica se o Pedido realmente existe, salvando o resultado em uma variável $check_pedido
        $check_pedido = Pedido::where([
            'id' => $idpedido,
            'user_id' => $idusuario,
            'status' => 'RE'
        ])->exists();
        
        //Caso a variável não exista, redirecionar para a página index do carrinho com uma mensagem de erro
        if(!$check_pedido) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }

        //Verifica se o(s) produto(s) existem, salvando o resultado em uma variavel $check_produtos
        $check_produtos = PedidoProduto::where([
            'pedido_id' => $idpedido
        ])->exists();
        
        //Caso a variável não exista, redirecionar para a página index do carrinho com uma mensagem de erro
        if(!$check_produtos){
            $request->session()->flash('mensagem-falha', 'Produto do pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }

        /**
         * CASO AS VALIDAÇÔES DE PEDIDO E DE PRODUTOS TENHAM SIDO APROVADAS
         */

        // Aqui ele altera o status dos produtos cujo id do pedido for igual, o stauts passa a ser PA
        PedidoProduto::where([
            'pedido_id' => $idpedido
        ])->update([
            'status' => 'PA'
        ]);
        
        // Aqui ele atualiza o status do Pedido para PA
        Pedido::where([
            'id' => $idpedido
        ])->update([
            'status' => 'PA'
        ]);
        
        /**
         * RESPOSTA FINAL
         */

        //Redirecionando para a página do carrinho com uma mensagem de sucesso
        $request->session()->flash('mensagem-sucesso', 'Compra concluida com sucesso!');

        return redirect()->route('carrinho.compras');
    }

    public function compras(){
        /* Consultar os registros de pedido com o status 'PA' e id do usuário logado*/
        $compras = Pedido::where([
            'status' => 'PA',
            'user_id' => Auth::id()
        ])->orderBy('created_at', 'desc')->get();

        $cancelados = Pedido::where([
            'status' => 'CA',
            'user_id' => Auth::id()
        ])->orderBy('updated_at', 'desc')->get();
        /* Retorna um json com os pedidos encontrados*/
        return view('carrinho.compras', compact('compras', 'cancelados'));
    }

    public function cancelar(Request $request)
    {
        //Verifica se o token existe
        $this->middleware('VerifyCsrfToken');

        $idpedido = $request->input('pedido_id');
        $idspedido_prod = $request->input('id');
        $idusuario = Auth::id();

        /* Verifica se o $idpedido_prod está vazio, se estiver redirecione para a rota em questão*/
        if(empty($idspedido_prod))
        {
            $request->session()->flash('mensagem-falha', 'Nenhum item selecionado para cancelamento');
            return redirect()->route('carrinho.compras');
        }

        /* Verifica se o pedido existe*/
        $check_pedido = Pedido::where([
            'id' => $idpedido,
            'user_id' => $idusuario,
            'status' => 'PA' //
        ])->exists();

        /* Se $check_pedido é nulo*/
        if(!$check_pedido)
        {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado para cancelamento!');
            return redirect()->route('carrinho.compras');
        }

        $check_produtos = PedidoProduto::where([
            'pedido_id' => $idpedido,
            'status' => 'PA'
        ])->whereIn('id', $idspedido_prod)->exists();
        
        if(!$check_produtos){
            $request->session()->flas('mensagem-falha', 'Produtos do pedido não encontrado!');
            return redirect()->route('carrinho.compras');
        }

        PedidoProduto::where([
            'pedido_id' => $idpedido,
            'status' => 'PA'
        ])->whereIn('id', $idspedido_prod)->update([
            'status' => 'CA'
        ]);

        $check_pedido_cancel = PedidoProduto::where([
            'pedido_id' => $idpedido,
            'status' => 'PA'
        ])->exists();

        if(!$check_pedido_cancel){
            Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'CA'
            ]);

            $request->session()->flash('mensagem-sucesso', 'Compra cancelada com sucesso!');
        } else{
            $request->session()->flash('mensagem-sucesso', 'Item(ns) da compra cancelado com sucesso!');
        }

        return redirect()->route('carrinho.compras');

    }

    public function desconto(Request $request){

        $this->middleware('VerifyCsrfToken');

        $idpedido = $request->input('pedido_id');
        $cupom = $request->input('cupom');
        $idusuario = Auth::id();

        if( empty($cupom) ) {
            $request->session()->flash('mensagem-falha', 'Cupom inválido!');
            return redirect()->route('carrinho.index');
        }

        $cupom = CupomDesconto::where([
            'localizador' => $cupom,
            'ativo' => 'S'
        ])->where('dthr_validade', '>', date('Y-m-d H:i:s'))->first();

        if(empty($cupom->id)){
            $request->session()->flash('mensagem-falha', 'Cupom de desconto não encontrado');
            return redirect()->route('carrinho.index');
        }

        $check_pedido = Pedido::where([
            'id' => $$idpedido, 
            'user_id' => $idusuario,
            'status' => 'RE'
        ])->exists();

        if( !$check_pedido ){
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado para validação!');
            return redirect()->route('carrinho.index');
        }

        $pedido_produtos = PedidoProduto::where([
            'pedido_id' => $idpedido, 
            'status' => 'RE'
        ])->get();

        if(empty($pedido_produtos)) {
            $request->session()->flash('mensagem-falha', 'Pedidos não encontrador para validação!');
            return redirect()->route('carrinho.index');
        }

        $aplicou_desconto = false;
        foreach($pedido_produtos as $pedido_produto){
            switch($cupom->modo_desconto){
                case 'porc';
                    $valor_desconto = ($pedido_produto->valor * $cupom->desconto) / 100;
                    break;
                default: 
                    $valor_desconto = $cupom->desconto;
                    break;
            }

            $valor_desconto = ($valor_desconto > $pedido_produto->valor) ? $pedido_produto->valor : number_format($valor_desconto, 2);

            switch($cupom->modo_limite){
                case 'qtd':
                    $qtd_pedido = PedidoProduto::whereIn('status', ['PA', 'RE'])->where([
                        'cupom_desconto_id' => $cupom->id
                    ])->count();
                    if($qtd_pedido >= $cupom->limite){
                        continue;
                    }
                    break;
                default:
                    $valor_ckc_descontos = PedidoProduto::whereIn('status', ['PA', 'RE'])->where([
                        'cupom_desconto_id' => $cupom->id
                    ])->sum('desconto');

                    if(($valor_ckc_descontos+$valor_desconto) > $cupom->limite){
                        continue;
                    }
                    break;
            }
            $pedido_produto->cupom_desconto_id = $cupom->id;
            $pedido_produto->desconto          = $valor_desconto;
            $pedido_produto->update();

            $aplicou_desconto = true;
            
        }

        if($aplicou_desconto){
            $request->session()->flash('mensagem-sucesso', 'Cupom aplicado com sucesso!');
        }else{
            $request->session()->flash('mensagem-falha', 'Cupom esgotado!');
        }
        return redirect()->route('carrinho.index');

    }
}
