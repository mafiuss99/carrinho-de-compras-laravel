<form action="{{ url('admin/produtos/salvar') }}" type="post">
    @csrf
    <input type="text" name="nome" placeholder="nome" required><br>
    <textarea name="descricao" id="" cols="30" rows="10" placeholer="descricao"></textarea><br>
    <input type="number" min="1" step="any" name="valor"><br>
    <input type="file" name="imagem"><br>
    <input type="hidden" name="ativo" value="S"></input>
    <button type="submit">Salvar</button>
</form>