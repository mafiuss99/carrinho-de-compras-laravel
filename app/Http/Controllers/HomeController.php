<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Genero;
use App\Estudio;

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
        $lancamentos = Produto::where([
            'lancamento' => 'S',
            'ativo' => 'S',
            'destaque' => 'S'
        ])->get();

        $generos = Genero::all();
        
        $destaques = Produto::where([
            'ativo' => 'S',
            'destaque' => 'S'
        ])->get();

        $estudios = Estudio::all();

        return view('home', compact('lancamentos', 'generos', 'destaques', 'estudios'));
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
