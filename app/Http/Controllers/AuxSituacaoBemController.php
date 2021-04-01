<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AuxSituacaoBem;

class AuxSituacaoBemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = AuxSituacaoBem::orderBy('descricao')->paginate(15);
        return view('auxSituacaoBem', compact('datas'));
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
            'descricao' => 'required',
        ]);

        AuxSituacaoBem::create($validatedData);
        return redirect('/auxsituacaobem')->with('success', 'Registro adicionado com sucesso!');
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
        $datas = AuxSituacaoBem::orderBy('descricao')->paginate(15);
        $dataEdit = AuxSituacaoBem::findOrFail($id);
        return view('auxSituacaoBem', compact('datas', 'dataEdit'));
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
            'descricao' => 'required',
        ]);

        AuxSituacaoBem::findOrFail($id)->update($validatedData);
        return redirect('/auxsituacaobem')->with('success', 'Registro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AuxSituacaoBem::findOrFail($id)->delete();
        return redirect('/auxsituacaobem')->with('success', 'Registro deletado com sucesso!');
    }
}
