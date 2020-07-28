<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tecnicos;
use App\User;
use Illuminate\Support\Facades\DB;

class TecnicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //$tecnicos = Tecnicos::orderBy('id', 'DESC')->paginate(10);
        //$tecnicos = DB::table('tecnicos')->leftJoin('users', 'users.id', 'tecnicos.user_id')->orderBy('users.name')->paginate(10);
        $tecnicos = Tecnicos::leftJoin('users', 'tecnicos.user_id', '=', 'users.id')->select('tecnicos.*', 'users.name')->orderBy('users.name')->paginate('10');
        $tecnicosTotal = Tecnicos::all();
        return view('tecnicosIndex', compact('tecnicos', 'tecnicosTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //O código abaixo pega todos os usuários que não estão cadastrados na tabela de tecnicos
        $users = DB::table('users')->whereNotIn('id',function($query){
            $query->select('user_id')->from('tecnicos');
        })->get();
        return view('tecnicosCreate', compact('users'));
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
            'user_id' => 'required',
        ]);
        $show = Tecnicos::create($validatedData);
        return redirect('/tecnicos')->with('success', 'Técnico cadastrado com sucesso!');
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
    // public function destroy($id)
    // {
    //     $tecnico = Tecnicos::findOrFail($id);
    //     $tecnico->delete();
    //     return redirect('/tecnicos')->with('success', 'Dado excluído com sucesso!');
    // }

    public function destroy($id)
    {
        $tecnico = Tecnicos::findOrFail($id);
        $tecnico->delete();
        return redirect('/tecnicos')->with('success', 'Chamado Excluído com sucesso!');
    }

}
