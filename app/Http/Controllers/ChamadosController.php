<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chamados;
use App\User;
use Illuminate\Support\Facades\DB;
use PDF;
use App\AuxSetores;
use App\AuxCategorias;

class ChamadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$chamados = Chamados::orderBy('id', 'DESC')->paginate(5);
        //$chamadosTotal = Chamados::all();
        $chamadosTotal = DB::table('chamados')->select('chamados.id', 'aux_categorias.categoria', 'chamados.created_at', 'chamados.categoria_id', 'chamados.user_id', 'chamados.descricao')
        ->leftJoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
        ->where('finished_at', '=', null)
        ->orderBy('chamados.id', 'DESC')
        ->get();
        $chamados = DB::table('chamados')->select('chamados.id', 'aux_categorias.categoria', 'chamados.created_at', 'chamados.categoria_id', 'chamados.user_id', 'chamados.descricao')
        ->leftJoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
        ->where('finished_at', '=', null)
        ->orderBy('chamados.id', 'DESC')
        ->paginate(5);
        $chamadosFinalizados = DB::table('chamados')->select('chamados.id', 'aux_categorias.categoria', 'chamados.created_at', 'chamados.categoria_id', 'chamados.user_id', 'chamados.descricao')
        ->leftJoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
        ->where('finished_at', '!=', null)
        ->orderBy('chamados.id', 'DESC')
        ->take(5)
        ->get();
        $chamadosFinalizadosTotal = DB::table('chamados')->select('chamados.id', 'aux_categorias.categoria', 'chamados.created_at', 'chamados.categoria_id', 'chamados.user_id', 'chamados.descricao')
        ->leftJoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
        ->where('finished_at', '!=', null)
        ->orderBy('chamados.id', 'DESC')
        ->get();
        return view('chamadoIndex', compact('chamados', 'chamadosTotal', 'chamadosFinalizados', 'chamadosFinalizadosTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('tecnicos')->leftJoin('users', 'users.id', 'tecnicos.user_id')->orderBy('users.name')->get();
        $setores = AuxSetores::all()->sortBy('nome');
        $categorias = AuxCategorias::all()->sortBy('categoria');
        return view('chamadoCreate', compact('users', 'setores', 'categorias'));
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
            'categoria_id' => 'required',
            'descricao' => 'required',
            'setor_id' => 'required',
            'user_id' => 'required',
            'solicitante' => 'required',
        ]);
        $show = Chamados::create($validatedData);
        return redirect('/chamados')->with('success', 'Chamado cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chamado = Chamados::findOrFail($id);
        $chamadoCompleto = DB::table('chamados')
        ->leftjoin('aux_setores', 'aux_setores.id', 'chamados.setor_id')
        ->leftjoin('users', 'users.id', 'chamados.user_id')
        ->leftjoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
        ->where('chamados.id','=',$id)
        ->get();
        $user = User::findOrFail($chamado->user_id);
        return view('chamadoShow', compact('chamado', 'chamadoCompleto', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chamado = Chamados::findOrFail($id);        
        $users = DB::table('tecnicos')->leftJoin('users', 'users.id', 'tecnicos.user_id')->orderBy('users.name')->get();
        $setores = AuxSetores::all();
        $categorias = AuxCategorias::all()->sortBy('categoria');     
        return view('chamadoEdit', compact('chamado', 'users', 'setores', 'categorias'));
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
            'categoria_id' => 'required',
            'descricao' => 'required',
            'setor_id' => 'required',
            'user_id' => '',
            'solicitante' => '',
        ]);
        Chamados::whereId($id)->update($validatedData);
        return redirect('/chamados')->with('success', 'Chamado Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chamado = Chamados::findOrFail($id);
        $chamado->delete();
        return redirect('/chamados')->with('success', 'Chamado Excluído com sucesso!');
    }

    public function finishPage($id){
        $chamado = Chamados::findOrFail($id);
        $tecnicos = DB::table('tecnicos')->leftJoin('users', 'users.id', 'tecnicos.user_id')->orderBy('users.name')->paginate(10);        
        //$categorias = DB::table('chamados')->leftJoin('aux_categorias', 'chamados.categoria_id', 'aux_categorias.id')->orderBy('chamados.id')->where('chamados.id','=',$id)->get();
        $categoria = AuxCategorias::findOrFail($chamado->categoria_id);
        return view('chamadoFinish', compact('chamado', 'tecnicos', 'categoria'));
    }

    public function finish(Request $request, $id)
    {
        $validatedData = $request->validate([
            'solucao' => 'required',
            'user_id' => 'required',
        ]);
        $validatedData['finished_at'] = now();
        Chamados::whereId($id)->update($validatedData);
        return redirect('/chamados')->with('success', 'Chamado Editado com sucesso!');
    }

    public function pdf($id){
        $chamado = Chamados::findOrFail($id);
        $chamadoCompleto = DB::table('chamados')
        ->leftjoin('aux_setores', 'aux_setores.id', 'chamados.setor_id')
        ->leftjoin('users', 'users.id', 'chamados.user_id')        
        ->leftjoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
        ->where('chamados.id','=',$id)
        ->get();
        $pdf = PDF::loadView('chamadoPdf', compact('chamado', 'chamadoCompleto'));
        return $pdf->stream();
        //return $pdf->download('chamadoPdf');
    }

    public function search(Request $request)
    {
        $search = $request->get('categoria_id');
        $categorias = AuxCategorias::all()->sortBy('categoria');
        if($search != ''){
            $chamados = DB::table('chamados')->select('chamados.id', 'aux_categorias.categoria', 'chamados.created_at', 'chamados.categoria_id', 'chamados.user_id', 'chamados.descricao')
            ->leftJoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
            ->where('aux_categorias.id', '=', $search)
            ->orderBy('chamados.id', 'DESC')
            ->paginate(10);
        }else{
            $chamados = DB::table('chamados')->select('chamados.id', 'aux_categorias.categoria', 'chamados.created_at', 'chamados.categoria_id', 'chamados.user_id', 'chamados.descricao')
            ->leftJoin('aux_categorias', 'aux_categorias.id', 'chamados.categoria_id')
            ->orderBy('chamados.id', 'DESC')
            ->paginate(10);
        }
        return view('chamadoSearch', compact('chamados', 'categorias'));
    }

}
