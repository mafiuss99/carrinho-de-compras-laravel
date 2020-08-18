<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CupomDesconto;

class CupomDescontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $cuponsdesconto = CupomDesconto::all();
       return view('admin.cupom_desconto.index', compact('cuponsdesconto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cupom_desconto.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cupomdesconto = new CupomDesconto();
        $cupomdesconto->fill($request->all());
        $cupomdesconto->save();
        return redirect('admin/cupons');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cupomdesconto = CupomDesconto::find($id);
        if(!empty($cupomdesconto)){
            return view('admin.cupom_desconto.detail', compact('cupomdesconto'));
        }
        return redirect('admin/cupons')->with('msg', 'Produto Não encontrado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cupomdesconto = CupomDesconto::find($id);
        if(!empty($cupomdesconto)){
            return view('admin.cupom_desconto.edit', compact('cupomdesconto'));
        }
        return redirect('admin/cupons')->with('msg', 'Produto Não encontrado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cupomdesconto = CupomDesconto::find($id);
        $cupomdesconto->fill($request->all());
        $cupomdesconto->save();
        return redirect('admin/cupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cupomdesconto = CupomDesconto::find($id);
        if(!empty($cupomdesconto)){
            $cupomdesconto->delete();
            return redirect('admin/cupons');
        }
        return redirect('admin/cupons')->with('msg', 'Produto Não encontrado');
        
    }
}
