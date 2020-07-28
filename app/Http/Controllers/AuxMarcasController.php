<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuxMarcas;
use App\AuxModelos;

class AuxMarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = AuxMarcas::orderBy('marca')->paginate(10);
        $marcasTotal = AuxMarcas::all();
        return view('auxMarcasIndex', compact('marcas', 'marcasTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auxMarcasCreate');
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
            'marca' => 'required',
        ]);
        $show = AuxMarcas::create($validatedData);
        return redirect('/auxmarcas')->with('success', 'Registro adicionado com sucesso');
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
        $marca = AuxMarcas::findOrFail($id);
        $marca->delete();
        return redirect('/auxmarcas')->with('success', 'Registro deletado com sucesso');
    }

    public function modelos($id)
    {
        //$marcas = AuxModelos::orderBy('modelo')->where('id', $id)->paginate(10);
        $modelos = AuxModelos::orderBy('Modelo')->where('marca_id', $id)->paginate(10);
        $modelosTotal = AuxModelos::where('marca_id', $id)->get();
        $marca_id = $id;
        return view('auxModelosIndex', compact('modelos', 'modelosTotal', 'marca_id'));
    }
}
