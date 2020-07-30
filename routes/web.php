<?php

use Illuminate\Support\Facades\Route;

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

//TECNOLOGIA
//CHAMADOS
Route::group(['prefix' => 'chamados', 'middleware' => ['role:chamados']], function() {
    Route::post('/', ['uses' => 'ChamadosController@store', 'as' => 'chamados.store'])->middleware('permission:create-chamados');
    Route::get('/', ['uses' => 'ChamadosController@index', 'as' => 'chamados.index'])->middleware('permission:read-chamados');
    Route::get('/create', ['uses' => 'ChamadosController@create', 'as' => 'chamados.create'])->middleware('permission:create-chamados');
    Route::delete('/{id}', ['uses' => 'ChamadosController@destroy', 'as' => 'chamados.destroy'])->middleware('permission:delete-chamados');
    Route::patch('/{id}', ['uses' => 'ChamadosController@update', 'as' => 'chamados.update'])->middleware('permission:update-chamados');
    Route::patch('/{id}/finish', ['uses' => 'ChamadosController@finish', 'as' => 'chamados.finish'])->middleware('permission:update-chamados');
    Route::get('/{id}', ['uses' => 'ChamadosController@show', 'as' => 'chamados.show'])->middleware('permission:read-chamados');
    Route::get('/{id}/finishPage', ['uses' => 'ChamadosController@finishPage', 'as' => 'chamados.finishPage'])->middleware('permission:update-chamados');
    Route::get('/{id}/edit', ['uses' => 'ChamadosController@edit', 'as' => 'chamados.edit'])->middleware('permission:update-chamados');
    Route::get('/{id}/pdf', ['uses' => 'ChamadosController@pdf', 'as' => 'chamados.pdf'])->middleware('permission:read-chamados');
});
//USUÁRIOS
Route::group(['prefix' => 'usuarios', 'middleware' => ['role:usuarios']], function() {
    Route::post('/', ['uses' => 'UsuariosController@store', 'as' => 'usuarios.store'])->middleware('permission:create-users');
    Route::get('/', ['uses' => 'UsuariosController@index', 'as' => 'usuarios.index']);
    Route::get('/search', ['uses' => 'UsuariosController@search', 'as' => 'usuarios.search']);
    Route::get('/create', ['uses' => 'UsuariosController@create', 'as' => 'usuarios.create'])->middleware('permission:create-users');
    Route::patch('/{id}/updatePassword', ['uses' => 'UsuariosController@updatePassword', 'as' => 'usuarios.updatePassword'])->middleware('permission:update-users');
});

//USUÁRIOS SERVIDOR DE ARQUIVO
Route::group(['prefix' => 'usuariosSA', 'middleware' => ['role:usuarios-sa']], function() {
    Route::post('/', ['uses' => 'UsuariosServidorArquivosController@store', 'as' => 'usuariossa.store'])->middleware('permission:create-usuariossa');
    Route::get('/', ['uses' => 'UsuariosServidorArquivosController@index', 'as' => 'usuariossa.index']);
    Route::get('/create', ['uses' => 'UsuariosServidorArquivosController@create', 'as' => 'usuariossa.create'])->middleware('permission:create-usuariossa');
    Route::delete('/{id}', ['uses' => 'UsuariosServidorArquivosController@destroy', 'as' => 'usuariossa.destroy'])->middleware('permission:delete-usuariossa');
    Route::patch('/{id}', ['uses' => 'UsuariosServidorArquivosController@update', 'as' => 'usuariossa.update'])->middleware('permission:update-usuariossa');
    Route::get('/{id}/edit', ['uses' => 'UsuariosServidorArquivosController@edit', 'as' => 'usuariossa.edit'])->middleware('permission:update-usuariossa');
});

//PESSOAS
Route::group(['prefix' => 'pessoas', 'middleware' => ['role:pessoas']], function() {
    Route::post('/', ['uses' => 'PessoasController@store', 'as' => 'pessoas.store'])->middleware('permission:create-pessoas');
    Route::get('/', ['uses' => 'PessoasController@index', 'as' => 'pessoas.index']);
    Route::get('/create', ['uses' => 'PessoasController@create', 'as' => 'pessoas.create'])->middleware('permission:create-pessoas');
    Route::delete('/{id}', ['uses' => 'PessoasController@destroy', 'as' => 'pessoas.destroy'])->middleware('permission:delete-pessoas');
    Route::patch('/{id}', ['uses' => 'PessoasController@update', 'as' => 'pessoas.update'])->middleware('permission:update-pessoas');
    Route::get('/{id}/edit', ['uses' => 'PessoasController@edit', 'as' => 'pessoas.edit'])->middleware('permission:update-pessoas');
});

//AUXILIARES DE TECNOLOGIA
Route::group(['prefix' => 'auxcategorias', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxCategoriasController@store', 'as' => 'categorias.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'AuxCategoriasController@index', 'as' => 'categorias.index']);
    Route::get('/create', ['uses' => 'AuxCategoriasController@create', 'as' => 'categorias.create'])->middleware('permission:create-aux-tecnologia');
    Route::delete('/{id}', ['uses' => 'AuxCategoriasController@destroy', 'as' => 'categorias.destroy'])->middleware('permission:delete-aux-tecnologia');
});

Route::group(['prefix' => 'auxfuncoes', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxFuncoesController@store', 'as' => 'funcoes.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'AuxFuncoesController@index', 'as' => 'funcoes.index']);
    Route::get('/create', ['uses' => 'AuxFuncoesController@create', 'as' => 'funcoes.create'])->middleware('permission:create-aux-tecnologia');
    Route::delete('/{id}', ['uses' => 'AuxFuncoesController@destroy', 'as' => 'funcoes.destroy'])->middleware('permission:delete-aux-tecnologia');
});

Route::group(['prefix' => 'auxmarcas', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxMarcasController@store', 'as' => 'marcas.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'AuxMarcasController@index', 'as' => 'marcas.index']);
    Route::get('/create', ['uses' => 'AuxMarcasController@create', 'as' => 'marcas.create'])->middleware('permission:create-aux-tecnologia');
    Route::get('/{id}', ['uses' => 'AuxMarcasController@modelos', 'as' => 'marcas.modelos']);
    Route::delete('/{id}', ['uses' => 'AuxMarcasController@destroy', 'as' => 'marcas.destroy'])->middleware('permission:delete-aux-tecnologia');
});

Route::group(['prefix' => 'auxmodelos', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxModelosController@store', 'as' => 'modelos.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'AuxModelosController@index', 'as' => 'modelos.index']);
    Route::get('/create/{id}', ['uses' => 'AuxModelosController@create', 'as' => 'modelos.create'])->middleware('permission:create-aux-tecnologia');
    Route::delete('/{id}', ['uses' => 'AuxModelosController@destroy', 'as' => 'modelos.destroy'])->middleware('permission:delete-aux-tecnologia');
});

Route::group(['prefix' => 'tecnicos', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'TecnicosController@store', 'as' => 'tecnicos.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'TecnicosController@index', 'as'=> 'tecnicos.index']);
    Route::get('/create', ['uses' => 'TecnicosController@create', 'as' => 'tecnicos.create'])->middleware('permission:create-aux-tecnologia');
    Route::delete('/{id}', ['uses' => 'TecnicosController@destroy', 'as' => 'tecnicos.destroy'])->middleware('permission:delete-aux-tecnologia');
});

Route::group(['prefix' => 'auxtiposcontratos', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxTiposContratosController@store', 'as' => 'tiposcontratos.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'AuxTiposContratosController@index', 'as' => 'tiposcontratos.index']);
    Route::get('/create', ['uses' => 'AuxTiposContratosController@create', 'as' => 'tiposcontratos.create'])->middleware('permission:create-aux-tecnologia');
    Route::delete('/{id}', ['uses' => 'AuxTiposContratosController@destroy', 'as' => 'tiposcontratos.destroy'])->middleware('permission:delete-aux-tecnologia');
});

Route::group(['prefix' => 'auxtiposequipamentos', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxTiposEquipamentosController@store', 'as' => 'tiposequipamentos.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'AuxTiposEquipamentosController@index', 'as' => 'tiposequipamentos.index']);
    Route::get('/create', ['uses' => 'AuxTiposEquipamentosController@create', 'as' => 'tiposequipamentos.create'])->middleware('permission:create-aux-tecnologia');
    Route::delete('/{id}', ['uses' => 'AuxTiposEquipamentosController@destroy', 'as' => 'tiposequipamentos.destroy'])->middleware('permission:delete-aux-tecnologia');
});

Route::group(['prefix' => 'setores', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxSetoresController@store', 'as' => 'setores.store'])->middleware('permission:create-aux-tecnologia');
    Route::get('/', ['uses' => 'AuxSetoresController@index', 'as'=> 'setores.index']);
    Route::get('/create', ['uses' => 'AuxSetoresController@create', 'as' => 'setores.create'])->middleware('permission:create-aux-tecnologia');
    Route::delete('/{id}', ['uses' => 'AuxSetoresController@destroy', 'as' => 'setores.destroy'])->middleware('permission:delete-aux-tecnologia');
});

//GERAL
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@indexGeral')->name('index');

Route::get('/home', 'HomeController@index')->name('home');

//INDEX ESPECÍFICO DE CADA SISTEMA
Route::get('/tecnologia', 'HomeController@indexTecnologia')->name('tecnologia');
Route::get('/RH', 'HomeController@indexRH')->name('rh');
