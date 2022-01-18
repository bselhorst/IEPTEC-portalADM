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

//AUX_EMPRESAS_TERCEIRIZADOS
Route::group(['prefix' => 'auxEmpresasTerceirizados', 'middleware' => ['role:rh']], function(){
    Route::post('/', ['uses' => 'AuxEmpresasTerceirizadosController@store', 'as' => 'auxempresasterceirizados.store']);
    Route::get('/', ['uses' => 'AuxEmpresasTerceirizadosController@index', 'as' => 'auxempresasterceirizados.index']);
    Route::delete('/{id}', ['uses' => 'AuxEmpresasTerceirizadosController@destroy', 'as' => 'auxempresasterceirizados.destroy']);
    Route::patch('/{id}', ['uses' => 'AuxEmpresasTerceirizadosController@update', 'as' => 'auxempresasterceirizados.update']);
    Route::get('/{id}/edit', ['uses' => 'AuxEmpresasTerceirizadosController@edit', 'as' => 'auxempresasterceirizados.edit']);
});

//AUX_UNIDADES
Route::group(['prefix' => 'auxunidades', 'middleware' => ['role:almoxarifado']], function(){
    Route::post('/', ['uses' => 'AuxUnidadesController@store', 'as' => 'auxunidades.store']);
    Route::get('/', ['uses' => 'AuxUnidadesController@index', 'as' => 'auxunidades.index']);
    Route::delete('/{id}', ['uses' => 'AuxUnidadesController@destroy', 'as' => 'auxunidades.destroy']);
    Route::patch('/{id}', ['uses' => 'AuxUnidadesController@update', 'as' => 'auxunidades.update']);
    Route::get('/{id}/edit', ['uses' => 'AuxUnidadesController@edit', 'as' => 'auxunidades.edit']);
});

//AUX_FORNECEDORES
Route::group(['prefix' => 'auxfornecedores', 'middleware' => ['role:almoxarifado']], function(){
    Route::post('/', ['uses' => 'AuxFornecedoresController@store', 'as' => 'auxfornecedores.store']);
    Route::get('/', ['uses' => 'AuxFornecedoresController@index', 'as' => 'auxfornecedores.index']);
    Route::delete('/{id}', ['uses' => 'AuxFornecedoresController@destroy', 'as' => 'auxfornecedores.destroy']);
    Route::patch('/{id}', ['uses' => 'AuxFornecedoresController@update', 'as' => 'auxfornecedores.update']);
    Route::get('/{id}/edit', ['uses' => 'AuxFornecedoresController@edit', 'as' => 'auxfornecedores.edit']);
});

//ALMOXARIFADO
Route::group(['prefix' => 'almoxarifado', 'middleware' => ['role:almoxarifado']], function(){
    Route::post('/', ['uses' => 'AlmoxarifadoItemsController@store', 'as' => 'almoxarifado.store']);
    Route::get('/', ['uses' => 'AlmoxarifadoItemsController@index', 'as' => 'almoxarifado.index']);
    Route::get('/search', ['uses' => 'AlmoxarifadoItemsController@search', 'as' => 'almoxarifado.search']);
    Route::delete('/{id}', ['uses' => 'AlmoxarifadoItemsController@destroy', 'as' => 'almoxarifado.destroy']);
    Route::patch('/{id}', ['uses' => 'AlmoxarifadoItemsController@update', 'as' => 'almoxarifado.update']);
    Route::get('/create', ['uses' => 'AlmoxarifadoItemsController@create', 'as' => 'almoxarifado.create']);
    Route::get('/retirar', ['uses' => 'AlmoxarifadoItemsController@retirar', 'as' => 'almoxarifado.retirar']);
    Route::get('/{id}/edit', ['uses' => 'AlmoxarifadoItemsController@edit', 'as' => 'almoxarifado.edit']);
    Route::post('/confirmRetirar', ['uses' => 'AlmoxarifadoItemsController@confirmRetirar', 'as' => 'almoxarifado.confirmRetirar']);
    Route::get('/historicoRetiradas', ['uses' => 'AlmoxarifadoItemsController@historico_retiradas', 'as' => 'almoxarifado.historico_retiradas']);
    Route::get('/historicoEntradas', ['uses' => 'AlmoxarifadoItemsController@historico_entradas', 'as' => 'almoxarifado.historico_entradas']);
    Route::post('/{id}/entrada', ['uses' => 'AlmoxarifadoItemsController@entrada', 'as' => 'almoxarifado.entrada']);
    Route::patch('/{id}/cancelarEntrada', ['uses' => 'AlmoxarifadoItemsController@cancelarEntrada', 'as' => 'almoxarifado.cancelarEntrada']);
    Route::patch('/{id}/cancelarRetirada', ['uses' => 'AlmoxarifadoItemsController@cancelarRetirada', 'as' => 'almoxarifado.cancelarRetirada']);
});

//TECNOLOGIA

//CALENDARIO
Route::group(['prefix' => 'calendario', 'middleware' => ['role:chamados']], function() {
    // Route::post('/', ['uses' => 'ChamadosController@store', 'as' => 'chamados.store']);
    Route::get('/', ['uses' => 'CalendarioController@index', 'as' => 'calendario.index']);
    // Route::get('/search', ['uses' => 'ChamadosController@search', 'as' => 'chamados.search']);
    // Route::get('/create', ['uses' => 'ChamadosController@create', 'as' => 'chamados.create']);
    // Route::delete('/{id}', ['uses' => 'ChamadosController@destroy', 'as' => 'chamados.destroy']);
    // Route::patch('/{id}', ['uses' => 'ChamadosController@update', 'as' => 'chamados.update']);
    // Route::patch('/{id}/finish', ['uses' => 'ChamadosController@finish', 'as' => 'chamados.finish']);
    // Route::get('/{id}', ['uses' => 'ChamadosController@show', 'as' => 'chamados.show']);
    // Route::get('/{id}/finishPage', ['uses' => 'ChamadosController@finishPage', 'as' => 'chamados.finishPage']);
    // Route::get('/{id}/edit', ['uses' => 'ChamadosController@edit', 'as' => 'chamados.edit']);
    // Route::get('/{id}/pdf', ['uses' => 'ChamadosController@pdf', 'as' => 'chamados.pdf']);
});

//CHAMADOS
Route::group(['prefix' => 'chamados', 'middleware' => ['role:chamados']], function() {
    Route::post('/', ['uses' => 'ChamadosController@store', 'as' => 'chamados.store']);
    Route::get('/', ['uses' => 'ChamadosController@index', 'as' => 'chamados.index']);
    Route::get('/search', ['uses' => 'ChamadosController@search', 'as' => 'chamados.search']);
    Route::get('/create', ['uses' => 'ChamadosController@create', 'as' => 'chamados.create']);
    Route::delete('/{id}', ['uses' => 'ChamadosController@destroy', 'as' => 'chamados.destroy']);
    Route::patch('/{id}', ['uses' => 'ChamadosController@update', 'as' => 'chamados.update']);
    Route::patch('/{id}/finish', ['uses' => 'ChamadosController@finish', 'as' => 'chamados.finish']);
    Route::get('/{id}', ['uses' => 'ChamadosController@show', 'as' => 'chamados.show']);
    Route::get('/{id}/finishPage', ['uses' => 'ChamadosController@finishPage', 'as' => 'chamados.finishPage']);
    Route::get('/{id}/edit', ['uses' => 'ChamadosController@edit', 'as' => 'chamados.edit']);
    Route::get('/{id}/pdf', ['uses' => 'ChamadosController@pdf', 'as' => 'chamados.pdf']);
});
//USUÁRIOS
Route::group(['prefix' => 'usuarios', 'middleware' => ['role:usuarios']], function() {
    Route::post('/', ['uses' => 'UsuariosController@store', 'as' => 'usuarios.store']);
    Route::get('/', ['uses' => 'UsuariosController@index', 'as' => 'usuarios.index']);
    Route::get('/search', ['uses' => 'UsuariosController@search', 'as' => 'usuarios.search']);
    Route::get('/create', ['uses' => 'UsuariosController@create', 'as' => 'usuarios.create']);
    //Route::patch('/{id}/updatePassword', ['uses' => 'UsuariosController@updatePassword', 'as' => 'usuarios.updatePassword'])->middleware('permission:update-users');
});

Route::group(['prefix' => 'usuarios'], function() {
    Route::patch('/{id}/updatePassword', ['uses' => 'UsuariosController@updatePassword', 'as' => 'usuarios.updatePassword']);
});

//USUÁRIOS SERVIDOR DE ARQUIVO
Route::group(['prefix' => 'usuariosSA', 'middleware' => ['role:usuarios-sa']], function() {
    Route::post('/', ['uses' => 'UsuariosServidorArquivosController@store', 'as' => 'usuariossa.store']);
    Route::get('/search', ['uses' => 'UsuariosServidorArquivosController@search', 'as' => 'usuariossa.search']);
    Route::get('/', ['uses' => 'UsuariosServidorArquivosController@index', 'as' => 'usuariossa.index']);
    Route::get('/create', ['uses' => 'UsuariosServidorArquivosController@create', 'as' => 'usuariossa.create']);
    Route::delete('/{id}', ['uses' => 'UsuariosServidorArquivosController@destroy', 'as' => 'usuariossa.destroy']);
    Route::patch('/{id}', ['uses' => 'UsuariosServidorArquivosController@update', 'as' => 'usuariossa.update']);
    Route::get('/{id}/edit', ['uses' => 'UsuariosServidorArquivosController@edit', 'as' => 'usuariossa.edit']);
});

//PATRIMONIO
//AUX_SITUACAO_BEM
Route::group(['prefix' => 'auxsituacaobem', 'middleware' => ['role:patrimonio']], function(){
    Route::post('/', ['uses' => 'AuxSituacaoBemController@store', 'as' => 'auxsituacaobem.store']);
    Route::get('/', ['uses' => 'AuxSituacaoBemController@index', 'as' => 'auxsituacaobem.index']);
    Route::delete('/{id}', ['uses' => 'AuxSituacaoBemController@destroy', 'as' => 'auxsituacaobem.destroy']);
    Route::patch('/{id}', ['uses' => 'AuxSituacaoBemController@update', 'as' => 'auxsituacaobem.update']);
    Route::get('/{id}/edit', ['uses' => 'AuxSituacaoBemController@edit', 'as' => 'auxsituacaobem.edit']);
});
//PATRIMONIO_BEM
Route::group(['prefix' => 'patrimoniobens', 'middleware' => ['role:patrimonio']], function() {
    Route::post('/', ['uses' => 'PatrimonioBemController@store', 'as' => 'patrimoniobens.store']);
    Route::get('/', ['uses' => 'PatrimonioBemController@index', 'as' => 'patrimoniobens.index']);
    Route::get('/search', ['uses' => 'PatrimonioBemController@search', 'as' => 'patrimoniobens.search']);
    Route::get('/create', ['uses' => 'PatrimonioBemController@create', 'as' => 'patrimoniobens.create']);
    Route::delete('/{id}', ['uses' => 'PatrimonioBemController@destroy', 'as' => 'patrimoniobens.destroy']);
    Route::patch('/{id}', ['uses' => 'PatrimonioBemController@update', 'as' => 'patrimoniobens.update']);
    Route::get('/{id}/edit', ['uses' => 'PatrimonioBemController@edit', 'as' => 'patrimoniobens.edit']);
});
//PATRIMONIO
Route::group(['prefix' => 'patrimonios', 'middleware' => ['role:patrimonio']], function() {
    Route::post('/', ['uses' => 'PatrimonioController@store', 'as' => 'patrimonio.store']);
    Route::get('/', ['uses' => 'PatrimonioController@index', 'as' => 'patrimonio.index']);
    Route::get('/search', ['uses' => 'PatrimonioController@search', 'as' => 'patrimonio.search']);
    Route::get('/create', ['uses' => 'PatrimonioController@create', 'as' => 'patrimonio.create']);
    Route::delete('/{id}', ['uses' => 'PatrimonioController@destroy', 'as' => 'patrimonio.destroy']);
    Route::patch('/{id}', ['uses' => 'PatrimonioController@update', 'as' => 'patrimonio.update']);
    Route::get('/{id}/edit', ['uses' => 'PatrimonioController@edit', 'as' => 'patrimonio.edit']);
});

//PESSOAS
Route::group(['prefix' => 'pessoas', 'middleware' => ['role:rh']], function() {
    Route::post('/', ['uses' => 'PessoasController@store', 'as' => 'pessoas.store']);
    Route::get('/', ['uses' => 'PessoasController@index', 'as' => 'pessoas.index']);
    Route::get('/search', ['uses' => 'PessoasController@search', 'as' => 'pessoas.search']);
    Route::get('/contratosGeralSearch', ['uses' => 'PessoasController@indexContratosGeralSearch', 'as' => 'pessoas.indexContratoGeralSearch']);
    Route::get('/contratosGeral', ['uses' => 'PessoasController@indexContratosGeral', 'as' => 'pessoas.indexContratoGeral']);
    Route::get('/create', ['uses' => 'PessoasController@create', 'as' => 'pessoas.create']);
    Route::get('/{id}/view', ['uses' => 'PessoasController@show', 'as' => 'pessoas.show']);
    Route::delete('/{id}', ['uses' => 'PessoasController@destroy', 'as' => 'pessoas.destroy']);
    Route::patch('/{id}', ['uses' => 'PessoasController@update', 'as' => 'pessoas.update']);
    Route::patch('/{id}/renovacaoContrato', ['uses' => 'PessoasController@renovacao', 'as' => 'pessoas.renovacao']);
    Route::get('/{id}/edit', ['uses' => 'PessoasController@edit', 'as' => 'pessoas.edit']);
});

//PESSOAS CONTRATOS
Route::group(['prefix' => 'pessoas/{pessoa_id}/contratos', 'middleware' => ['role:rh']], function() {
    Route::post('/', ['uses' => 'PessoaContratosController@store', 'as' => 'contratos.store']);
    Route::get('/', ['uses' => 'PessoaContratosController@index', 'as' => 'contratos.index']);
    Route::get('/create', ['uses' => 'PessoaContratosController@create', 'as' => 'contratos.create']);
    Route::delete('/{id}', ['uses' => 'PessoaContratosController@destroy', 'as' => 'contratos.destroy']);
    Route::delete('/{id}/view/contractDestroy', ['uses' => 'PessoaContratosController@showdestroy', 'as' => 'contratos.showdestroy']);
    Route::patch('/{id}', ['uses' => 'PessoaContratosController@update', 'as' => 'contratos.update']);
    Route::patch('/{id}/updateContrato', ['uses' => 'PessoaContratosController@updateContrato', 'as' => 'contratos.updateContrato']);
    Route::patch('/{id}/renovarContrato', ['uses' => 'PessoaContratosController@renovarContrato', 'as' => 'contratos.renovarContrato']);
    Route::patch('/{id}/renovarContratoCG', ['uses' => 'PessoaContratosController@renovarContratoCG', 'as' => 'contratos.renovarContrato']);
    Route::patch('/{id}/updateContratoShow', ['uses' => 'PessoaContratosController@updateContratoShow', 'as' => 'contratos.updateContratoShow']);
    Route::get('/{id}/edit', ['uses' => 'PessoaContratosController@edit', 'as' => 'contratos.edit']);
});

//AUXILIARES DE TECNOLOGIA
Route::group(['prefix' => 'auxcategorias', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxCategoriasController@store', 'as' => 'categorias.store']);
    Route::get('/', ['uses' => 'AuxCategoriasController@index', 'as' => 'categorias.index']);
    Route::get('/create', ['uses' => 'AuxCategoriasController@create', 'as' => 'categorias.create']);
    Route::delete('/{id}', ['uses' => 'AuxCategoriasController@destroy', 'as' => 'categorias.destroy']);
});

Route::group(['prefix' => 'auxfuncoes', 'middleware' => ['role:rh']], function(){
    Route::post('/', ['uses' => 'AuxFuncoesController@store', 'as' => 'funcoes.store']);
    Route::get('/', ['uses' => 'AuxFuncoesController@index', 'as' => 'funcoes.index']);
    Route::get('/create', ['uses' => 'AuxFuncoesController@create', 'as' => 'funcoes.create']);
    Route::delete('/{id}', ['uses' => 'AuxFuncoesController@destroy', 'as' => 'funcoes.destroy']);
});

Route::group(['prefix' => 'auxmarcas', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxMarcasController@store', 'as' => 'marcas.store']);
    Route::get('/', ['uses' => 'AuxMarcasController@index', 'as' => 'marcas.index']);
    Route::get('/create', ['uses' => 'AuxMarcasController@create', 'as' => 'marcas.create']);
    Route::get('/{id}', ['uses' => 'AuxMarcasController@modelos', 'as' => 'marcas.modelos']);
    Route::delete('/{id}', ['uses' => 'AuxMarcasController@destroy', 'as' => 'marcas.destroy']);
});

Route::group(['prefix' => 'auxmodelos', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxModelosController@store', 'as' => 'modelos.store']);
    Route::get('/', ['uses' => 'AuxModelosController@index', 'as' => 'modelos.index']);
    Route::get('/create/{id}', ['uses' => 'AuxModelosController@create', 'as' => 'modelos.create']);
    Route::delete('/{id}', ['uses' => 'AuxModelosController@destroy', 'as' => 'modelos.destroy']);
});

Route::group(['prefix' => 'tecnicos', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'TecnicosController@store', 'as' => 'tecnicos.store']);
    Route::get('/', ['uses' => 'TecnicosController@index', 'as'=> 'tecnicos.index']);
    Route::get('/create', ['uses' => 'TecnicosController@create', 'as' => 'tecnicos.create']);
    Route::delete('/{id}', ['uses' => 'TecnicosController@destroy', 'as' => 'tecnicos.destroy']);
});

Route::group(['prefix' => 'auxtiposcontratos', 'middleware' => ['role:rh']], function(){
    Route::post('/', ['uses' => 'AuxTiposContratosController@store', 'as' => 'tiposcontratos.store']);
    Route::get('/', ['uses' => 'AuxTiposContratosController@index', 'as' => 'tiposcontratos.index']);
    Route::get('/create', ['uses' => 'AuxTiposContratosController@create', 'as' => 'tiposcontratos.create']);
    Route::delete('/{id}', ['uses' => 'AuxTiposContratosController@destroy', 'as' => 'tiposcontratos.destroy']);
});

Route::group(['prefix' => 'auxtiposequipamentos', 'middleware' => ['role:auxiliar-tecnologia']], function(){
    Route::post('/', ['uses' => 'AuxTiposEquipamentosController@store', 'as' => 'tiposequipamentos.store']);
    Route::get('/', ['uses' => 'AuxTiposEquipamentosController@index', 'as' => 'tiposequipamentos.index']);
    Route::get('/create', ['uses' => 'AuxTiposEquipamentosController@create', 'as' => 'tiposequipamentos.create']);
    Route::delete('/{id}', ['uses' => 'AuxTiposEquipamentosController@destroy', 'as' => 'tiposequipamentos.destroy']);
});

Route::group(['prefix' => 'setores', 'middleware' => ['role:rh']], function(){
    Route::post('/', ['uses' => 'AuxSetoresController@store', 'as' => 'setores.store']);
    Route::get('/', ['uses' => 'AuxSetoresController@index', 'as'=> 'setores.index']);
    Route::get('/create', ['uses' => 'AuxSetoresController@create', 'as' => 'setores.create']);
    Route::delete('/{id}', ['uses' => 'AuxSetoresController@destroy', 'as' => 'setores.destroy']);
});

//GERAL
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@indexGeral')->name('index');

Route::get('/home', 'HomeController@index')->name('home');

//INDEX ESPECÍFICO DE CADA SISTEMA
Route::get('/tecnologia', 'HomeController@indexTecnologia')->name('tecnologia');
Route::get('/RH', 'HomeController@indexRH')->name('rh')->middleware('role:rh');

//Server Status
Route::get('/status', function (){
    return view('status');
});
