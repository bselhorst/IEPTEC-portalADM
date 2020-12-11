<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoas;
use App\PessoaContratos;

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
        return view('pessoaContratosIndex', compact('data', 'pessoa_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pessoa_id)
    {
        return view('pessoaContratosForm', compact('pessoa_id'));
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
    public function edit($id)
    {
        $data
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
        //
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
}
