<form action="{{ url('admin/cupons/atualizar/'.$cupomdesconto->id) }}" type="post">
    @csrf
    <input type="text" name="nome" value="{{$cupomdesconto->nome}}"><br>
    <input type="text" name="localizador" value="{{$cupomdesconto->localizador}}"><br>
    <input type="text" name="desconto" value="{{$cupomdesconto->desconto}}"><br>
    <select name="modo_desconto" id="" value="{{$cupomdesconto->modo_desconto}}">
        <option value="valor">Valor</option>
        <option value="qtd">Quantidade</option>
    </select><br>
    <input type="date" name="dthr_validade" value="{{$cupomdesconto->dthr_validade}}"><br>
    <select name="ativo" id="" value="{{$cupomdesconto->ativo}}">
        <option value="S">S</option>
        <option value="N">N</option>
    </select><br>
    <button type="submit">Cadastrar</button>
</form> 