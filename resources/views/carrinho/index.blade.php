@extends('layout')
@section('pagina_titulo', 'Carrinho')

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <h3>Produtos no carrinho</h3>
        <hr/>

        @if(Session::has('mensagem-sucesso'))
            <div class="card-panel green">
                <strong>{{ Session::get('mensagem-sucesso') }}</strong>
            </div>
        @endif
        @if(Session::has('mensagem-falha'))
            <div class="card-panel">
                <strong>{{ Session::get('mensagem-falha') }}</strong>
            </div>
        @endif
        @forelse($pedidos as $pedido)
            <h5 class="col 16 s12 m6">Pedido: {{ $pedido->id }} </h5>
            <h5 class="col 16 s12 m6">Criado em: {{ $pedido->created_at }}</h5>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Qtd</th>
                        <th>Produto</th>
                        <th>Valor Unit</th>
                        <th>Desconto(s)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_pedido = 0;
                    @endphp
                    @foreach($pedido->pedido_produto as $pp)
                        <tr>
                            <td>
                                <img width="100" height="100" src="{{ $pp->produto->imagem }}" alt="prod_image">
                            </td>
                            <td class="center-align">
                                <div class="center-align">
                                    <a class="col 14 m4 s4" href="#" onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pp->produto_id }}, 1)">
                                        <i class="material-icons small">remove_circle_outline</i>
                                    </a>
                                    <span class="col 14 m4 s4">{{ $pp->qtd }}</span>
                                    <a class="col 14 m4 s4" href="#" onclick="carrinhoAdicionarProduto({{ $pp->produto_id }})">
                                        <i class="material-icons small">add_circle_outline</i>
                                    </a>
                                </div>
                                <a href="#" class="tooltipped" data-position="right" data-delay="50" data-tooltip="Retirar produto do carrinho" onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pp->produto_id }}, 0)">Retirar produto</a>
                            </td>
                            <td> {{ $pp->produto->nome }} </td>
                            <td> R$ {{ number_format($pp->produto->valor, 2, ',', '.') }} </td>
                            <td> R$ {{ number_format($pp->descontos, 2, ',', '.') }} </td>
                            @php
                                $total_produto = $pp->valores - $pp->desconto;
                                $total_pedido += $total_produto
                            @endphp
                            <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <strong class="col offset-l6 offset-m6 offset-s6 m4 s4 right-align">
                    Total do Pedido: 
                </strong>
                <span class="col 12 m2 s2">R$ {{ number_format($total_pedido, 2, ',', '.') }}</span>
            </div>
            <div class="row">
                <form action="{{ route('carrinho.desconto') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}"> 
                    <strong class="col s4 m4 l3 offset-l4 right-align">
                        Cupom Desconto: 
                    </strong>
                    <input type="text" class="col s6 m6 l3" name="cupom">
                    <button>validar</button>
                </form>
            </div>
            <div class="row">
                <a href="" class="btn-large tooltipped col l4 s4 m4 offset-l8 offset-s8 offset-m8" data-position="top" data-delay="50" data-tooltip="Voltar a página inicial para continuar comprando?" href="/">Continuar Comprando</a>
                <form action="{{ route('carrinho.concluir') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <button type="submit" class="btn-large blue col offset-l1 offset-s1 offset-m1 l5 s5 m5 tooltipped" data-position="top" data-delay="50" data-tooltip="Adquirir os produtos concluindo a compra?">
                        Concluir compra
                    </button>
                </form>
            </div>
        @empty
            <h5>Não há nenhum produto no carrinho</h5>
        @endforelse
    </div>
</div>

<form id="form-remover-produto" method="POST" action="{{ route('carrinho.remover') }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="pedido_id">
    <input type="hidden" name="produto_id">
    <input type="hidden" name="item">
</form>

<form id="form-adicionar-produto" method="POST" action="{{ route('carrinho.adicionar') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id">
</form>

@push('scripts')
    <script type="text/javascript" src="js/carrinho.js"></script>
@endpush

@endsection