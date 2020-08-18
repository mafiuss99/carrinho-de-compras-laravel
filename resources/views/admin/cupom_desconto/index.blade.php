<a href="cupons/adicionar">Cadastrar</a>
<br>
@foreach($cuponsdesconto as $cupom)
    {{$cupom->nome}}
    {{$cupom->localizador}}
    {{$cupom->desconto}}
    {{$cupom->modo_desconto}}
    {{$cupom->dthr_validade}}
    {{$cupom->validade}}
    <a href="cupons/{{$cupom->id}}">Ver</a>
    <a href="cupons/editar/{{$cupom->id}}">Editar</a>
    <a href="cupons/deletar/{{$cupom->id}}">Excluir</a>
@endforeach