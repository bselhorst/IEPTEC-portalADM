<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoas;
use App\PessoaContratos;
use App\AuxSetores;
use App\AuxEmpresasTerceirizados;
use App\AuxTiposContratos;
use App\HistoricoPessoaContratos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PessoaContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pessoa_id)
    {
        $data = PessoaContratos::where('pessoa_id', $pessoa_id)->orderBy('id', 'desc')->paginate(15);
        $data_person = Pessoas::findOrFail($pessoa_id);
        return view('pessoaContratosIndex', compact('data', 'pessoa_id', 'data_person'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pessoa_id)
    {
        $setores = DB::table('aux_setores')->orderBy('nome')->get();
        $empresas = DB::table('aux_empresas_terceirizados')->orderBy('nome')->get();
        $funcoes = DB::table('aux_funcoes')->orderBy('funcao')->get();
        $tipo_contratos = AuxTiposContratos::orderBy('tipo_contrato')->get();
        return view('pessoaContratosForm', compact('pessoa_id', 'setores', 'tipo_contratos', 'empresas', 'funcoes'));
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
            'tipo_contrato_id' => 'required',
            'empresa_id' => '',
            'pessoa_id' => 'required',
            'setor_id' => 'required',
            'funcao_id' => '',
            'matricula' => '',
            'termo_portaria' => '',
            'carga_horaria' => '',
            'salario' => '',
            'data_nomeacao' => 'required',
            'data_exoneracao' => '',
        ]);
        if(!$validatedData['salario']){
            $validatedData['salario'] = 0;
        }
        $validatedData['salario'] = str_replace("R$ ", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(".", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(",", ".", $validatedData['salario']);
        $validatedData['status'] = 1;
        $new = PessoaContratos::create($validatedData);
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "adicionou",
            "descricao" => json_encode($new, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        return redirect('pessoas/'.$validatedData['pessoa_id'].'/contratos')->with('success', 'Registro adicionado com sucesso!');
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
    public function edit($pessoa_id, $id)
    {
        $data = PessoaContratos::findOrFail($id);
        $setores = DB::table('aux_setores')->orderBy('nome')->get();
        $empresas = DB::table('aux_empresas_terceirizados')->orderBy('nome')->get();
        $funcoes = DB::table('aux_funcoes')->orderBy('funcao')->get();
        $tipo_contratos = AuxTiposContratos::orderBy('tipo_contrato')->get();
        return view('pessoaContratosForm', compact('pessoa_id', 'data', 'setores', 'tipo_contratos', 'empresas', 'funcoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pessoa_id, $id)
    {
        $validatedData = $request->validate([
            'tipo_contrato_id' => 'required',
            'empresa_id' => '',
            'pessoa_id' => 'required',
            'setor_id' => 'required',
            'funcao_id' => '',
            'matricula' => '',
            'termo_portaria' => '',
            'carga_horaria' => '',
            'salario' => '',
            'data_nomeacao' => 'required',
            'data_exoneracao' => '',
        ]);
        if(!$validatedData['salario']){
            $validatedData['salario'] = 0;
        }
        $validatedData['salario'] = str_replace("R$ ", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(".", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(",", ".", $validatedData['salario']);
        PessoaContratos::whereId($id)->update($validatedData);
        $validatedData["id"] = $id;
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "adicionou",
            "descricao" => json_encode($validatedData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        return redirect('pessoas/'.$validatedData['pessoa_id'].'/contratos')->with('success', 'Registro alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pessoa_id, $id)
    {
        $validatedData = PessoaContratos::findOrFail($id);
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "deletou",
            "descricao" => json_encode($validatedData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        PessoaContratos::findOrFail($id)->delete();
        return redirect('pessoas/'.$pessoa_id.'/contratos')->with('success', 'Registro deletado com sucesso!');
    }

    public function showdestroy($pessoa_id, $id)
    {
        $validatedData = PessoaContratos::findOrFail($id);
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "deletou",
            "descricao" => json_encode($validatedData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        PessoaContratos::findOrFail($id)->delete();
        return redirect('pessoas/'.$pessoa_id.'/view')->with('success', 'Registro deletado com sucesso!');
    }

    public function updateContrato($pessoa_id, $id){
        $item = PessoaContratos::findOrFail($id);
        if ($item['status'] == 0){
            $validatedData['status'] = 1;
        }else{
            $validatedData['status'] = 0;
        }
        $histData = [
            "id" => "$id",
            "pessoa_id" => "$pessoa_id",
            "status" => $item['status'],
        ];
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "alterou status",
            "descricao" => json_encode($histData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        PessoaContratos::whereId($id)->update($validatedData);
        return redirect('pessoas/'.$pessoa_id.'/contratos')->with('success', 'Registro alterado com sucesso');
    }

    public function updateContratoShow($pessoa_id, $id){
        $item = PessoaContratos::findOrFail($id);
        if ($item['status'] == 0){
            $validatedData['status'] = 1;
        }else{
            $validatedData['status'] = 0;
        }
        $histData = [
            "id" => $id,
            "pessoa_id" => $pessoa_id,
            "status" => $item['status'],
        ];
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "alterou status",
            "descricao" => json_encode($histData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        PessoaContratos::whereId($id)->update($validatedData);
        return redirect('pessoas/'.$pessoa_id.'/view')->with('success', 'Registro alterado com sucesso');
    }

    public function renovarContrato(Request $request, $pessoa_id, $id){
        $item['renovacao'] = "SIM";
        $item['data_nova_exoneracao'] = $request["data_nova_exoneracao"];
        $item['data_renovacao'] = $request["data_renovacao"];
        $validatedData = [
            "id" => $id,
            "pessoa_id" => $pessoa_id,
            "data_nova_exoneracao" => $item['data_nova_exoneracao'],
            "data_renovacao" => $item['data_renovacao'],
        ];
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "renovou",
            "descricao" => json_encode($validatedData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        PessoaContratos::whereId($id)->update($item);
        return redirect('pessoas/'.$request['pessoa_id'].'/contratos')->with('success', 'Registro alterado com sucesso!');
    }

    public function renovarContratoCG(Request $request, $pessoa_id, $id){
        $item['renovacao'] = "SIM";
        $item['data_nova_exoneracao'] = $request["data_nova_exoneracao"];
        $item['data_renovacao'] = $request["data_renovacao"];
        $validatedData = [
            "id" => $id,
            "pessoa_id" => $pessoa_id,
            "data_nova_exoneracao" => $item['data_nova_exoneracao'],
            "data_renovacao" => $item['data_renovacao'],
        ];
        $historicoData = [
            "usuario" => Auth::user()->name,
            "acao" => "renovou",
            "descricao" => json_encode($validatedData, JSON_UNESCAPED_UNICODE),
        ];
        HistoricoPessoaContratos::create($historicoData);
        PessoaContratos::whereId($id)->update($item);
        return redirect('pessoas/contratosGeral')->with('success', 'Registro alterado com sucesso!');
    }
}
