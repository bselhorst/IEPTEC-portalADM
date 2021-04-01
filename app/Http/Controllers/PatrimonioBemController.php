<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatrimonioBem;
use Illuminate\Support\Facades\DB;

class PatrimonioBemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PatrimonioBem::orderBy('descricao')->paginate(20);
        return view('patrimonioBemIndex', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patrimonioBemForm');
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
            'marca' => '',
            'modelo' => '',
            'cor' => '',
        ]);

        PatrimonioBem::create($validatedData);
        return redirect('/patrimoniobens')->with('success', 'Registro adicionado com sucesso!');
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
        $data = PatrimonioBem::findOrFail($id);
        return view('patrimonioBemForm', compact('data'));
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
            'marca' => '',
            'modelo' => '',
            'cor' => '',
        ]);

        PatrimonioBem::findOrFail($id)->update($validatedData);
        return redirect('/patrimoniobens')->with('success', 'Registro editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PatrimonioBem::findOrFail($id)->delete();
        return redirect('/patrimoniobens')->with('success', 'Registro deletado com sucesso');
    }

    public function search(Request $request){
        $search = $request->get('descricao');
        $data = DB::table('patrimonio_bems')->where('descricao', 'like', '%'.$search.'%')->paginate(15);
        return view('patrimonioBemIndex', compact('data'));
    }
}
