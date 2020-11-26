<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AlmoxarifadoItems;
use App\AlmoxarifadoEntradas;
use App\AlmoxarifadoRetiradas;
use App\AuxUnidades;
use App\AuxFornecedores;

class AlmoxarifadoItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = DB::table('almoxarifado_items')->paginate(15);
        $data = DB::table('almoxarifado_items')->select('almoxarifado_items.id', 'almoxarifado_items.codigo', 'almoxarifado_items.descricao', 'almoxarifado_items.estoque_minimo', 'almoxarifado_items.saldo', 'almoxarifado_items.unidade_id', 'aux_unidades.unidade')
        ->leftJoin('aux_unidades', 'aux_unidades.id', 'almoxarifado_items.unidade_id')
        ->orderBy('almoxarifado_items.descricao', 'ASC')
        ->paginate(15);
        $fornecedores = DB::table('aux_fornecedores')->orderBy('nome')->get();
        return view('almoxarifadoIndex', compact('data', 'fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = AuxUnidades::orderBy('descricao')->get();
        return view('almoxarifadoForm', compact('unidades'));
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
            'codigo' => '',
            'descricao' => 'required',
            'unidade_id' => 'required',
            'estoque_minimo' => 'required',
            'saldo' => 'required',
        ]);

        AlmoxarifadoItems::create($validatedData);
        return redirect('/almoxarifado')->with('success', 'Registro adicionado com sucesso');
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
        $data = AlmoxarifadoItems::findOrFail($id);
        $unidades = AuxUnidades::orderBy('descricao')->get();
        return view('almoxarifadoForm', compact('data', 'unidades'));
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
            'codigo' => '',
            'descricao' => 'required',
            'unidade_id' => 'required',
            'estoque_minimo' => 'required',
            'saldo' => 'required',
        ]);

        AlmoxarifadoItems::whereId($id)->update($validatedData);
        return redirect('/almoxarifado')->with('success', 'Registro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AlmoxarifadoItems::findOrFail($id)->delete();
        return redirect('/almoxarifado')->with('success', 'Registro deletado com sucesso!');
    }

    public function search(Request $request){
        $pesquisa = $request->get('pesquisa');
        $data = DB::table('almoxarifado_items')
        ->select('almoxarifado_items.id', 'almoxarifado_items.codigo', 'almoxarifado_items.descricao', 'almoxarifado_items.estoque_minimo', 'almoxarifado_items.saldo', 'almoxarifado_items.unidade_id', 'aux_unidades.unidade')
        ->leftJoin('aux_unidades', 'aux_unidades.id', 'almoxarifado_items.unidade_id')
        ->where('almoxarifado_items.descricao', 'like', '%'.$pesquisa.'%')
        ->orWhere('almoxarifado_items.codigo', 'like', '%'.$pesquisa.'%')
        ->paginate(15);
        $fornecedores = DB::table('aux_fornecedores')->orderBy('nome')->get();
        return view('almoxarifadoIndex', compact('data', 'fornecedores'));
    }

    public function retirar(){
        $data = DB::table('almoxarifado_items')->select('almoxarifado_items.id', 'almoxarifado_items.codigo', 'almoxarifado_items.descricao', 'almoxarifado_items.estoque_minimo', 'almoxarifado_items.saldo', 'almoxarifado_items.unidade_id', 'aux_unidades.unidade')
        ->leftJoin('aux_unidades', 'aux_unidades.id', 'almoxarifado_items.unidade_id')
        ->where('almoxarifado_items.saldo','>',0)
        ->orderBy('almoxarifado_items.descricao', 'ASC')
        ->paginate(15);
        return view('almoxarifadoRetirar', compact('data'));
    }

    public function generate_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
    }

    public function confirmRetirar(Request $request){
        $data = $request->all();
        $tokenCodigo = $this->generate_uuid();
        for($i=0; $i<count($data['unidade']); $i++){
            $item = AlmoxarifadoItems::findOrFail($data["unidade"][$i]);
            if($item->saldo >= $data["quantidade"][$i]){
                $values = [
                    "token" => $data['_token'],
                    "item_id" => $data["unidade"][$i],
                    "codigo" => $tokenCodigo,
                    "quantidade" => $data["quantidade"][$i],
                    "solicitante" => $data["solicitante"],
                    "usuario" => $data["usuario"],
                ];
                AlmoxarifadoRetiradas::create($values);
                AlmoxarifadoItems::where('id', $data["unidade"][$i])->decrement('saldo', floatval($data["quantidade"][$i]));
            }
        }
        //AlmoxarifadoRetiradas::create($validatedData);
        return redirect('/almoxarifado')->with('success', 'Registro editado com sucesso!');
    }

    public function historico_retiradas(){
        $data = AlmoxarifadoRetiradas::select('codigo', 'solicitante', 'created_at', 'usuario')
        ->orderBy('created_at', 'DESC')
        ->groupBy('codigo', 'solicitante', 'created_at', 'usuario')
        ->paginate(15);
        /*$data = DB::table('almoxarifado_retiradas')->select('almoxarifado_retiradas.codigo', 'almoxarifado_retiradas.solicitante', 'almoxarifado_retiradas.created_at')
        ->groupBy('almoxarifado_retiradas.codigo')
        ->paginate(15);*/
        return view('almoxarifadoHistoricoRetiradas', compact('data'));
    }

    public function historico_entradas(){
        $data = DB::table('almoxarifado_entradas')
        ->select('almoxarifado_entradas.id', 'almoxarifado_entradas.fornecedor_id', 'almoxarifado_entradas.quantidade', 'almoxarifado_entradas.valor_unitario', 'almoxarifado_entradas.valor_total', 'almoxarifado_entradas.created_at', 'aux_fornecedores.nome')
        ->leftJoin('aux_fornecedores', 'aux_fornecedores.id', 'almoxarifado_entradas.fornecedor_id')
        ->orderBy('created_at', 'DESC')->paginate(15);
        return view('almoxarifadoHistoricoEntradas', compact('data'));
    }

    public function entrada(Request $request, $id){
        $validatedData = $request->validate([
            'item_id' => '',
            'fornecedor_id' => 'required',
            'quantidade' => 'required',
            'valor_unitario' => '',
            'valor_total' => '',
        ]);
        //$validatedData['usuario'] = Auth::user()->name;

        //Tratamento bem básico
        $validatedData['item_id'] = $id;
        $validatedData['valor_unitario'] = str_replace("R$ ", "", $validatedData['valor_unitario']);
        $validatedData['valor_unitario'] = str_replace(".", "", $validatedData['valor_unitario']);
        $validatedData['valor_unitario'] = str_replace(",", ".", $validatedData['valor_unitario']);
        $validatedData['valor_total'] = str_replace("R$ ", "", $validatedData['valor_total']);
        $validatedData['valor_total'] = str_replace(".", "", $validatedData['valor_total']);
        $validatedData['valor_total'] = str_replace(",", ".", $validatedData['valor_total']);

        AlmoxarifadoEntradas::create($validatedData);
        AlmoxarifadoItems::where('id', $id)->increment('saldo', floatval($validatedData["quantidade"]));
        return redirect('/almoxarifado')->with('success', 'Registro adicionado com sucesso');
    }

    public function cancelarEntrada(Request $request, $id)
    {
        $entrada = AlmoxarifadoEntradas::findOrFail($id);
        AlmoxarifadoItems::where('id', $entrada->item_id)->decrement('saldo', floatval($entrada->quantidade));
        AlmoxarifadoEntradas::findOrFail($id)->delete();
        return redirect('/almoxarifado')->with('success', 'Registro deletado com sucesso!');
    }

    public function cancelarRetirada(Request $request, $id)
    {
        $retiradas = DB::table('almoxarifado_retiradas')->where('codigo', $id)->get();
        foreach($retiradas as $retirada){
            AlmoxarifadoItems::where('id', $retirada->item_id)->increment('saldo', floatval($retirada->quantidade));
            AlmoxarifadoRetiradas::findOrFail($retirada->id)->delete();
        }

        return redirect('/almoxarifado')->with('success', 'Registro deletado com sucesso!');
    }

}
