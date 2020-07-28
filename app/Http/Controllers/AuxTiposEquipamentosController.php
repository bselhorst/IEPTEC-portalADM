<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuxTiposEquipamentos;

class AuxTiposEquipamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposEquipamentos = AuxTiposEquipamentos::orderBy('tipo_equipamento')->paginate(10);
        $tiposEquipamentosTotal = AuxTiposEquipamentos::all();
        return view('auxTiposEquipamentosIndex', compact('tiposEquipamentos', 'tiposEquipamentosTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auxTiposEquipamentosCreate');
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
            'tipo_equipamento' => 'required',
        ]);
        $show = AuxTiposEquipamentos::create($validatedData);
        return redirect('/auxtiposequipamentos')->with('success', 'Tipo de Equipamento adicionado com sucesso!');
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
        //
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
    public function destroy($id)
    {
        $tipoEquipamento = AuxTiposEquipamentos::findOrFail($id);
        $tipoEquipamento->delete();
        return redirect('/auxtiposequipamentos')->with('success', 'Registro deletado com sucesso');
    }
}
