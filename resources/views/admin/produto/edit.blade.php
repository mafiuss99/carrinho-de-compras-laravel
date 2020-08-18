<form action="{{url('admin/produtos/atualizar')}}/{{$produto->id}}" type="put">
    <input type="text" name="nome" placeholder="nome" value="{{$produto->nome}}"required><br>
    <textarea name="descricao" id="" cols="30" rows="10" placeholer="descricao" >{{$produto->descricao}}</textarea><br>
    <input type="number" min="1" step="any" name="valor" value="{{$produto->valor}}"><br>
    <input type="file" name="imagem" value="{{$produto->imagem}}"><br>
    <input type="hidden" name="ativo" value="S"></input>
    <button type="submit">Salvar</button>
</form>