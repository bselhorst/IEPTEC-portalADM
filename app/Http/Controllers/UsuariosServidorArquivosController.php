<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsuariosServidorArquivos;
use App\AuxSetores;
use Illuminate\Support\Facades\DB;
use App\AuxUsaFolder;
use App\UsaPermission;

class UsuariosServidorArquivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$usuarios = UsuariosServidorArquivos::orderBy('colaborador')->paginate(10);
        $usuarios = DB::table('usuarios_servidor_arquivos')->select('usuarios_servidor_arquivos.id', 'usuarios_servidor_arquivos.setor_id', 'usuarios_servidor_arquivos.tipo', 'usuarios_servidor_arquivos.colaborador', 'usuarios_servidor_arquivos.login', 'usuarios_servidor_arquivos.status', 'aux_setores.nome as setor')
        ->leftJoin('aux_setores', 'aux_setores.id', 'usuarios_servidor_arquivos.setor_id')
        ->orderBy('usuarios_servidor_arquivos.colaborador', 'ASC')
        ->paginate(20);
        return view('usuariosServidorArquivosIndex', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setores = AuxSetores::orderBy('nome')->get();
        $folders = AuxUsaFolder::orderBy('nome')->get();
        return view('usuariosServidorArquivosCreate', compact('setores', 'folders'));
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
            'setor_id' => 'required',
            'tipo' => 'required',
            'colaborador' => 'required',
            'login' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $show = UsuariosServidorArquivos::create($validatedData);
        foreach($data['acesso'] as $acesso){
            $vd['user_id'] = $show['id'];
            $vd['folder_id'] = $acesso;
            UsaPermission::create($vd);
        }

        return redirect('/usuariosSA')->with('success', 'Registro criado com sucesso!');
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
        $usuario = UsuariosServidorArquivos::findOrFail($id);
        $setores = AuxSetores::orderBy('nome')->get();
        $folders = AuxUsaFolder::orderBy('nome')->get();
        $permissions = DB::table('usa_permissions')->select('folder_id')->where('user_id', $id)->get();
        return view('usuariosServidorArquivosEdit', compact('usuario', 'setores', 'folders', 'permissions'));
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
            'setor_id' => 'required',
            'tipo' => 'required',
            'colaborador' => 'required',
            'login' => '',
            'status' => '',
        ]);
        UsuariosServidorArquivos::whereId($id)->update($validatedData);
        DB::table('usa_permissions')->where('user_id', $id)->delete();
        $data = $request->all();
        if(property_exists((object) $data,'acesso')){
            foreach($data['acesso'] as $acesso){
                $vd['user_id'] = $id;
                $vd['folder_id'] = $acesso;
                UsaPermission::create($vd);
            }
        }
        return redirect('/usuariosSA')->with('success', 'Registro Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = UsuariosServidorArquivos::findOrFail($id);
        $usuario->delete();
        return redirect('/usuariosSA')->with('success', 'Registro excluído com sucesso!');
    }

    public function search(Request $request){
        $search = $request->get('name');
        $usuarios = DB::table('usuarios_servidor_arquivos')->select('usuarios_servidor_arquivos.id', 'usuarios_servidor_arquivos.setor_id', 'usuarios_servidor_arquivos.tipo', 'usuarios_servidor_arquivos.colaborador', 'usuarios_servidor_arquivos.login', 'usuarios_servidor_arquivos.status', 'aux_setores.nome as setor')
        ->leftJoin('aux_setores', 'aux_setores.id', 'usuarios_servidor_arquivos.setor_id')
        ->where('colaborador', 'like', '%'.$search.'%')
        ->orderBy('usuarios_servidor_arquivos.colaborador', 'ASC')
        ->paginate(20);
        return view('usuariosServidorArquivosIndex', compact('usuarios'));
    }
}
