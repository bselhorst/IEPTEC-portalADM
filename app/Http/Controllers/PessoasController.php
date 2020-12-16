<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoas;
use App\PessoaContratos;
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
        //$data = Pessoas::orderBy('nome')->paginate(15);


        $contratos = DB::table('pessoa_contratos')->select('pessoa_id', 'data_nomeacao', 'data_exoneracao')->orderBy('pessoa_contratos.id', 'DESC');
        $data = DB::table('pessoas')
        ->leftJoinSub($contratos, 'pessoa_contratos', function ($join){
            $join->on('pessoas.id', '=', 'pessoa_contratos.pessoa_id');
        })->orderBy('pessoas.nome')
        ->paginate(15);

        // $data = DB::table('pessoas')
        // ->select('pessoas.id', 'pessoas.nome', 'pessoa_contratos.data_nomeacao', 'pessoa_contratos.data_exoneracao')
        // ->leftJoin('pessoa_contratos', 'pessoas.id', 'pessoa_contratos.pessoa_id')
        // ->orderBy('pessoas.nome')
        // ->orderBy('pessoa_contratos.id', 'DESC')
        // ->paginate(15);

        return view('pessoasIndex', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pessoasForm');
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
            'nome' => 'required',
            'filiacao1' => '',
            'filiacao2' => '',
            'rg' => '',
            'orgaoExp' => '',
            'cpf' => '',
            'sexo' => '',
            'dataNascimento' => '',
            'rua' => '',
            'numero' => '',
            'apt' => '',
            'bairro' => '',
            'municipio' => '',
            'complemento' => '',
            'cep' => '',
            'telefone' => '',
            'celular' => '',
            'email' => '',
            'nomeDeEmergencia' => '',
            'numeroEmergencia' => '',
        ]);
        $show = Pessoas::create($validatedData);
        return redirect('/pessoas')->with('success', 'Registro adicionado com sucesso!');
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
        $data = Pessoas::findOrFail($id);
        return view('pessoasForm', compact('data'));
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
            'nome' => 'required',
            'filiacao1' => '',
            'filiacao2' => '',
            'rg' => '',
            'orgaoExp' => '',
            'cpf' => '',
            'sexo' => '',
            'dataNascimento' => '',
            'rua' => '',
            'numero' => '',
            'apt' => '',
            'bairro' => '',
            'municipio' => '',
            'complemento' => '',
            'cep' => '',
            'telefone' => '',
            'celular' => '',
            'email' => '',
            'nomeDeEmergencia' => '',
            'numeroEmergencia' => '',
        ]);
        Pessoas::whereId($id)->update($validatedData);
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
