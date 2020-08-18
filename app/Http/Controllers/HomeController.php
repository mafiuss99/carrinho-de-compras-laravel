<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Consulta de todos os produtos cujo ativo é igual a 'S'
        $registros = Produto::where([
            'ativo' => 'S'
        ])->get();

        return view('home', compact('registros'));
    }

    public function produto($id = null){
        //Verifica se o parametro passado é diferente de nulo
        if( !empty($id) ){
            $registro = Produto::where([
                'id' => $id,
                'ativo' => 'S'
            ])->first();
            
            //Verifica se o resultado da consulta anterior é diferente de vazio
            if( !empty($registro)){
                return view('home.produto', compact('registro'));
            }
        }
        return redirect()->route('index');
    }
}
