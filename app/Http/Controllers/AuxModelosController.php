<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuxModelos;
use App\AuxMarcas;

class AuxModelosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $modelos = AuxModelos::orderBy('Modelo')->paginate(10);
        $modelosTotal = AuxModelos::all();
        return view('auxModelosIndex', compact('modelos', 'modelosTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $marca = AuxMarcas::findOrFail($id);
        return view('auxModelosCreate', compact('marca'));
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
            'marca_id' => 'required',
            'modelo' => 'required',
        ]);
        $show = AuxModelos::create($validatedData);
        //return redirect("/auxmarcas")->with('success', 'Dado cadastrado com sucesso');
        $modelos = AuxModelos::orderBy('Modelo')->where('marca_id', $validatedData['marca_id'])->paginate(10);
        $modelosTotal = AuxModelos::where('marca_id', $validatedData['marca_id'])->get();
        $marca_id = $validatedData['marca_id'];
        return view('auxModelosIndex', compact('modelos', 'modelosTotal', 'marca_id'));
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
        $modelo = AuxModelos::findOrFail($id);
        $marca_id = $modelo->marca_id;
        $modelo->delete();
        $modelos = AuxModelos::orderBy('Modelo')->where('marca_id', $marca_id)->paginate(10);
        $modelosTotal = AuxModelos::where('marca_id', $marca_id)->get();
        $marca_id = $marca_id;
        return view('auxModelosIndex', compact('modelos', 'modelosTotal', 'marca_id'));
    }
}
