<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/produto/{id}', 'HomeController@produto')->name('produto');
Route::get('/carrinho', 'CarrinhoController@index')->name('carrinho.index')->middleware('auth');
Route::get('/carrinho/adicionar', function(){
    return redirect()->route('index');
});
Route::post('/carrinho/adicionar', 'CarrinhoController@store')->name('carrinho.adicionar')->middleware('auth');;
Route::delete('/carrinho/remover', 'CarrinhoController@destroy')->name('carrinho.remover');
Route::post('/carrinho/concluir', 'CarrinhoController@concluir')->name('carrinho.concluir');
Route::get('/carrinho/compras', 'CarrinhoController@compras')->name('carrinho.compras');
Route::post('/carrinho/cancelar', 'CarrinhoController@cancelar')->name('carrinho.cancelar');
Route::post('/carrinho/desconto', 'CarrinhoController@desconto')->name('carrinho.desconto');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin.index')->middleware('auth');
    Route::get('produtos', 'Admin\ProdutoController@index')->name('admin.produtos')->middleware('auth');
    Route::get('produtos/{id}', 'Admin\ProdutoController@show')->name('admin.produtos')->middleware('auth');
    Route::get('produtos/adicionar', 'Admin\ProdutoController@create')->name('admin.produtos.adicionar')->middleware('auth');
    Route::get('produtos/salvar', 'Admin\ProdutoController@store')->name('admin.produtos.salvar')->middleware('auth');
    Route::get('produtos/editar/{id}', 'Admin\ProdutoController@edit')->name('admin.produtos.editar')->middleware('auth');
    Route::get('produtos/atualizar/{id}', 'Admin\ProdutoController@update')->name('admin.produtos.atualizar')->middleware('auth');
    Route::get('produtos/deletar/{id}', 'Admin\ProdutoController@destroy')->name('admin.produtos.deletar')->middleware('auth');

    Route::get('cupons', 'Admin\CupomDescontoController@index')->name('admin.cupons')->middleware('auth');
    Route::get('cupons/{id}', 'Admin\CupomDescontoController@show')->name('admin.cupom')->middleware('auth');
    Route::get('cupons/adicionar', 'Admin\CupomDescontoController@create')->name('admin.cupons.adicionar')->middleware('auth');
    Route::get('cupons/salvar', 'Admin\CupomDescontoController@store')->name('admin.cupons.salvar')->middleware('auth');
    Route::get('cupons/editar/{id}', 'Admin\CupomDescontoController@edit')->name('admin.cupons.editar')->middleware('auth');
    Route::get('cupons/atualizar/{id}', 'Admin\CupomDescontoController@update')->name('admin.cupons.atualizar')->middleware('auth');
    Route::get('cupons/deletar/{id}', 'Admin\CupomDescontoController@destroy')->name('admin.cupons.deletar')->middleware('auth');
});