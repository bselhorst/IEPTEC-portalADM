<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AuxFornecedores;

class AuxFornecedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::table('aux_fornecedores')->orderBy('nome')->paginate(15);
        return view('auxFornecedores', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'descricao' => 'required',
            'cnpj' => '',
        ]);

        AuxFornecedores::create($validatedData);
        return redirect('/auxfornecedores')->with('success', 'Registro adicionado com sucesso');
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
        $datas = DB::table('aux_fornecedores')->paginate(15);
        $dataEdit = AuxFornecedores::findOrFail($id);
        return view('auxFornecedores', compact('datas', 'dataEdit'));
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
            'descricao' => 'required',
            'cnpj' => '',
        ]);

        AuxFornecedores::whereId($id)->update($validatedData);
        return redirect('/auxfornecedores')->with('success', 'Registro editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AuxFornecedores::findOrFail($id)->delete();
        return redirect('/auxfornecedores')->with('success', 'Registro deletado com sucesso!');
    }
}
