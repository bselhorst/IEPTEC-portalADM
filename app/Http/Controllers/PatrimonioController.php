<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patrimonio;
use App\PatrimonioBem;
use App\AuxSituacaoBem;
use App\AuxSetores;
use Illuminate\Support\Facades\DB;

class PatrimonioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Patrimonio::paginate(15);
        $data = DB::table('patrimonios')
        ->select('patrimonios.id', 'patrimonio_bems.descricao as bem', 'patrimonio_bems.marca as marca', 'patrimonio_bems.modelo as modelo', 'patrimonio_bems.cor as cor', 'aux_situacao_bems.descricao as situacao', 'aux_setores.nome as setor_origem', 'patrimonios.setor_destino_id', 'patrimonios.local_especifico', 'patrimonios.numero_pat_see', 'patrimonios.numero_pat_ieptec', 'patrimonios.numero_pat_interno', 'patrimonios.locado')
        ->leftjoin('aux_setores', 'aux_setores.id', 'patrimonios.setor_origem_id')
        // ->join('aux_setores', function ($join) {
        //     $join->on('patrimonios.setor_origem_id', '=', 'aux_setores.id')->orOn('patrimonios.setor_destino_id', '=', 'aux_setores.id');
        // })
        ->leftjoin('aux_situacao_bems', 'aux_situacao_bems.id', 'patrimonios.situacao_id')
        ->leftjoin('patrimonio_bems', 'patrimonio_bems.id', 'patrimonios.bem_id')
        ->orderBy('id')
        ->paginate(15);
        return view("patrimonioIndex", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $situacoes = AuxSituacaoBem::orderBy('descricao')->get();
        $setores = AuxSetores::orderBy('nome')->get();
        $bens = PatrimonioBem::orderBy('descricao')->get();
        return view("patrimonioForm", compact('situacoes', 'setores', 'bens'));
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
            'bem_id' => 'required',
            'situacao_id' => '',
            'numero_pat_see' => '',
            'numero_pat_interno' => '',
            'numero_pat_ieptec' => '',
            'setor_origem_id' => '',
            'locado' => '',
            'setor_destino_id' => '',
            'local_especifico' => '',
        ]);

        Patrimonio::create($validatedData);

        return redirect('/patrimonios')->with('success', 'Registro cadastrado com sucesso!');
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
        $situacoes = AuxSituacaoBem::orderBy('descricao')->get();
        $setores = AuxSetores::orderBy('nome')->get();
        $bens = PatrimonioBem::orderBy('descricao')->get();
        $data = Patrimonio::findOrFail($id);
        return view("patrimonioForm", compact('data', 'situacoes', 'setores', 'bens'));
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
            'bem_id' => 'required',
            'situacao_id' => '',
            'numero_pat_see' => '',
            'numero_pat_interno' => '',
            'numero_pat_ieptec' => '',
            'setor_origem_id' => '',
            'locado' => '',
            'setor_destino_id' => '',
            'local_especifico' => '',
        ]);

        Patrimonio::findOrFail($id)->update($validatedData);
        return redirect('/patrimonios')->with('success', 'Registro alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patrimonio::findOrFail($id)->delete();
        return redirect('/patrimonios')->with('success', 'Registro alterado com sucesso!');
    }
}
