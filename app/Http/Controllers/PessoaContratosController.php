<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoas;
use App\PessoaContratos;
use App\AuxSetores;
use Illuminate\Support\Facades\DB;

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
        return view('pessoaContratosForm', compact('pessoa_id', 'setores'));
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
            'pessoa_id' => 'required',
            'setor_id' => 'required',
            'matricula' => '',
            'termo_portaria' => '',
            'carga_horaria' => '',
            'salario' => '',
            'data_nomeacao' => 'required',
            'data_exoneracao' => '',
        ]);
        $validatedData['salario'] = str_replace("R$ ", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(".", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(",", ".", $validatedData['salario']);
        $validatedData['status'] = 1;
        PessoaContratos::create($validatedData);
        return redirect('/'.$validatedData['pessoa_id'].'/contratos')->with('success', 'Registro adicionado com sucesso!');
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
        return view('pessoaContratosForm', compact('pessoa_id', 'data', 'setores'));
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
            'pessoa_id' => 'required',
            'setor_id' => 'required',
            'matricula' => '',
            'termo_portaria' => '',
            'carga_horaria' => '',
            'salario' => '',
            'data_nomeacao' => 'required',
            'data_exoneracao' => '',
        ]);
        $validatedData['salario'] = str_replace("R$ ", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(".", "", $validatedData['salario']);
        $validatedData['salario'] = str_replace(",", ".", $validatedData['salario']);
        if(!$validatedData['salario']){
            $validatedData['salario'] = 0;
        }
        PessoaContratos::whereId($id)->update($validatedData);
        return redirect('/'.$validatedData['pessoa_id'].'/contratos')->with('success', 'Registro adicionado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pessoa_id, $id)
    {
        PessoaContratos::findOrFail($id)->delete();
        return redirect('/'.$pessoa_id.'/contratos')->with('success', 'Registro deletado com sucesso!');
    }

    public function updateContrato($pessoa_id, $id){
        $item = PessoaContratos::findOrFail($id);
        if ($item['status'] == 0){
            $validatedData['status'] = 1;
        }else{
            $validatedData['status'] = 0;
        }
        PessoaContratos::whereId($id)->update($validatedData);
        return redirect('/'.$pessoa_id.'/contratos')->with('success', 'Registro alterado com sucesso');
    }
}
