<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AuxEmpresasTerceirizados;

class AuxEmpresasTerceirizadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('aux_empresas_terceirizados')->orderBy('nome')->paginate(15);
        return view("auxEmpresasTerceirizados", compact('data'));
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

        AuxEmpresasTerceirizados::create($validatedData);
        return redirect('/auxEmpresasTerceirizados')->with('success', 'Registro adicionado com sucesso');
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
        $data = DB::table('aux_empresas_terceirizados')->paginate(15);
        $dataEdit = AuxEmpresasTerceirizados::findOrFail($id);
        return view('auxEmpresasTerceirizados', compact('data', 'dataEdit'));
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

        AuxEmpresasTerceirizados::whereId($id)->update($validatedData);
        return redirect('/auxEmpresasTerceirizados')->with('success', 'Registro editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AuxEmpresasTerceirizados::findOrFail($id)->delete();
        return redirect('/auxEmpresasTerceirizados')->with('success', 'Registro deletado com sucesso!');
    }
}
