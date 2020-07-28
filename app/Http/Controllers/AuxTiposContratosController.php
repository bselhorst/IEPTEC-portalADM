<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuxTiposContratos;

class AuxTiposContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposContratos = AuxTiposContratos::orderBy('tipo_contrato')->paginate(15);
        return view('auxTiposContratosIndex', compact('tiposContratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auxTiposContratosCreate');
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
            'tipo_contrato' => 'required',
        ]);
        $create = AuxTiposContratos::create($validatedData);
        return redirect('/auxtiposcontratos')->with('success', 'Dados registrado com sucesso!');
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
        $tipo_contrato = AuxTiposContratos::findOrFail($id);
        $tipo_contrato->delete();
        return redirect('/auxtiposcontratos')->with('success', 'Registro deletado');
    }
}
