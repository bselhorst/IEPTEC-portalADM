<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoas;
use App\PessoaContratos;
use App\AuxSetores;
use App\AuxTiposContratos;
use App\AuxFuncoes;
use App\HistoricoPessoas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pessoas::orderBy('nome')->paginate(15);
        return view('pessoasIndex', compact('data'));
    }

    public function indexContratosGeral(){

        $data = DB::table('pessoas')
        ->select('pessoas.id', 'pessoas.nome', 'pessoa_contratos.data_nomeacao', 'pessoa_contratos.data_exoneracao', 'pessoa_contratos.id as contrato_id', 'pessoa_contratos.renovacao', 'pessoa_contratos.data_renovacao', 'pessoa_contratos.data_nova_exoneracao')
        ->leftJoin('pessoa_contratos', 'pessoas.id', 'pessoa_contratos.pessoa_id')
        ->where('pessoa_contratos.status', 1)
        ->orderBy('pessoas.nome')
        ->orderBy('pessoa_contratos.id', 'DESC')
        ->paginate(15);

        return view('pessoasContratosGeralIndex', compact('data'));
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
        $new = Pessoas::create($validatedData);
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "adicionou",
            "descricao" => json_encode($new, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoas::create($historicoData);
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
        $data = Pessoas::findOrFail($id);
        $contracts = PessoaContratos::where('pessoa_id', $id)->orderBy('id', 'desc')->paginate(15);
        return view('pessoasView', compact('data', 'contracts'));
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
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "editou",
            "descricao" => json_encode($validatedData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoas::create($historicoData);
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
        $nome = Pessoas::findOrFail($id);
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "deletou",
            "descricao" => json_encode($nome, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoas::create($historicoData);
        Pessoas::findOrFail($id)->delete();
        return redirect('/pessoas')->with('success', 'Registro excluído com sucesso!');
    }

    public function renovacao(Request $request, $id){
        $item['renovacao'] = "SIM";
        $item['data_renovacao'] = $request["data_renovacao"];
        PessoaContratos::whereId($id)->update($item);
        return redirect('/pessoas/contratosGeral')->with('success', 'Renovação realizada');
    }

    public function search(Request $request){
        $search = $request->get('name');
        $data = DB::table('pessoas')->where('nome', 'like', '%'.$search.'%')->paginate(15);
        return view('pessoasIndex', compact('data'));
    }

    public function indexContratosGeralSearch(Request $request){

        $data = DB::table('pessoas')
        ->select('pessoas.id', 'pessoas.nome', 'pessoa_contratos.data_nomeacao', 'pessoa_contratos.data_exoneracao', 'pessoa_contratos.id as contrato_id', 'pessoa_contratos.renovacao', 'pessoa_contratos.data_renovacao', 'pessoa_contratos.data_nova_exoneracao')
        ->leftJoin('pessoa_contratos', 'pessoas.id', 'pessoa_contratos.pessoa_id')
        ->where('nome', 'like', '%'.$request->get('name').'%')
        ->orderBy('pessoas.nome')
        ->orderBy('pessoa_contratos.id', 'DESC')
        ->paginate(15);

        return view('pessoasContratosGeralIndex', compact('data'));
    }
}
