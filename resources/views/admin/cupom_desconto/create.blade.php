<form action="{{ url('admin/cupons/salvar') }}" type="post">
    @csrf
    <input type="text" name="nome"><br>
    <input type="text" name="localizador"><br>
    <input type="text" name="desconto"><br>
    <select name="modo_desconto" id="">
        <option value="valor">Valor</option>
        <option value="qtd">Quantidade</option>
    </select><br>
    <input type="date" name="dthr_validade"><br>
    <select name="ativo" id="">
        <option value="S">S</option>
        <option value="N">N</option>
    </select><br>
    <button type="submit">Cadastrar</button>
</form> 