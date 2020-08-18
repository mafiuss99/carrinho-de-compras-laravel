<a href="produtos/adicionar">Cadastrar</a>
<br>
<br>
<br>
@foreach($produtos as $produto)
    {{$produto->nome}}
    {{$produto->descricao}}
    {{$produto->valor}}
    {{$produto->imagem}}
    {{$produto->ativo}}
    <a href="{{ url('admin/produtos/'.$produto->id) }}">Visualizar</a>
    <a href="{{ url('admin/produtos/deletar/'.$produto->id) }}">Excluir</a>
    <a href="{{ url('admin/produtos/editar/'.$produto->id) }}">Editar</a>
    <br>
@endforeach

