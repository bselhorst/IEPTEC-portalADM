<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoas;
use App\AuxSetores;
use App\AuxTiposContratos;
use App\AuxFuncoes;
use Illuminate\Support\Facades\DB;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$pessoas = Pessoas::orderBy('nome')->paginate(15);
        $pessoas = DB::table('pessoas')->select('pessoas.id', 'pessoas.nome', 'pessoas.origem', 'pessoas.telefone', 'pessoas.email', 'aux_setores.nome as setor', 'aux_funcoes.funcao', 'aux_tipos_contratos.tipo_contrato')
        ->leftJoin('aux_setores', 'aux_setores.id', 'pessoas.setor_id')
        ->leftJoin('aux_tipos_contratos', 'aux_tipos_contratos.id', 'pessoas.tipo_contrato_id')
        ->leftJoin('aux_funcoes', 'aux_funcoes.id', 'pessoas.funcao_id')
        ->orderBy('pessoas.nome')
        ->paginate(5);
        return view('pessoasIndex', compact('pessoas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setores = AuxSetores::all()->sortBy('nome');
        $tiposContratos = AuxTiposContratos::all()->sortBy('tipo_contrato');
        $funcoes = AuxFuncoes::all()->sortBy('funcao');
        return view('pessoasCreate', compact('setores', 'tiposContratos', 'funcoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'setor_id' => 'required',
            'tipo_contrato_id' => 'required',
            'funcao_id' => 'required',
            'nome' => 'required',
            'origem' => 'required',
            'telefone' => 'required',
            'email' => 'required',
        ]);
        $create = Pessoas::create($validatedData);
        return redirect('/pessoas')->with('success', 'Dado adicionado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setores = AuxSetores::all()->sortBy('nome');
        $tiposContratos = AuxTiposContratos::all()->sortBy('tipo_contrato');
        $funcoes = AuxFuncoes::all()->sortBy('funcao');
        $pessoa = Pessoas::findOrFail($id);
        return view('pessoasEdit', compact('setores', 'tiposContratos', 'funcoes', 'pessoa'));
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
        $validatedData = $request->validate([
            'setor_id' => 'required',
            'tipo_contrato_id' => 'required',
            'funcao_id' => 'required',
            'nome' => 'required',
            'origem' => '',
            'telefone' => 'required',
            'email' => 'required',
        ]);
        //3 formas de fazer
        //A primeira é usando uma variável e depois usar o update
        //$pessoa = Pessoas::findOrFail($id);
        //$pessoa->update($validatedData);
        //A segunda é usando diretamente o findOrFail com update
        Pessoas::findOrFail($id)->update($validatedData);
        //A terceira é com whereId
        //Pessoas::whereId($id)->update($validatedData);
        return redirect('/pessoas')->with('success', 'Registro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pessoas::findOrFail($id)->delete();
        return redirect('/pessoas');
    }
}
