@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Usuários do Servidor de Arquivos</span>
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('usuariossa.index') }}" class="breadcrumb-item active"><i class="icon-users mr-2"></i> Usuarios do servidor de arquivos</a>
@endsection

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success bg-white alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <h6 class="alert-heading font-weight-semibold mb-1">Sucesso</h6>
        {!!\Session::get('success')!!}
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <form class="form-validate-jquery" method="GET" action="/usuariosSA/search">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Pesquisar</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Colaborador<span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" placeholder="Nome Completo">
                        </div>
                    </div>
                </fieldset>

                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary ml-3">Pesquisar <i class="icon-search4 ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click" data-fab-state="closed">
            <li>
                <a href="#" class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
                    <i class="fab-icon-open icon-paragraph-justify3"></i>
                    <i class="fab-icon-close icon-cross2"></i>
                </a>
                <ul class="fab-menu-inner">
                    @permission('create-usuariossa')
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('usuariossa.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
                                <i class="icon-plus2"></i>
                            </a>
                        </div>
                    </li>
                    @endpermission
                    <li>
                        <div data-fab-label="Dashboard">
                            <a href="#" class="btn btn-light rounded-round btn-icon btn-float">
                                <i class="icon-bars-alt"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="col-xl-12">
            <!-- Support tickets -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 50px">Tipo</th>
                                <th style="width: 50px">Setor</th>
                                <th style="width: 50px">Colaborador</th>
                                <th style="width: 50px">Acesso</th>
                                <th style="width: 50px">Login</th>
                                <th style="width: 50px">Status</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="table-active table-border-double">
                                <td colspan="6">Usuários do Sistema de Arquivos</td>
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{ $usuarios->total() }}</span>
                                </td>
                            </tr>

                            <!--Ticket começa aqui-->
                            @foreach($usuarios as $usuario)
                                @php
                                    $folders = DB::table('usa_permissions')
                                    ->select('aux_usa_folders.nome')
                                    ->leftJoin('aux_usa_folders', 'aux_usa_folders.id', 'usa_permissions.folder_id')
                                    ->where('user_id', $usuario->id)
                                    ->orderBy('aux_usa_folders.nome')
                                    ->get()
                                @endphp
                                <tr>
                                    <td>{{ $usuario->tipo }}</td>
                                    <td>{{ $usuario->setor }}</td>
                                    <td>{{ $usuario->colaborador }}</td>
                                    <td>
                                        @foreach ($folders as $folder)
                                            {{ "[".$folder->nome."]" }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $usuario->login }}</td>
                                    <td>{{ $usuario->status }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @permission('update-usuariossa')
                                                    <a href="{{ route('usuariossa.edit', $usuario->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Editar</a>
                                                    @endpermission
                                                    @permission('delete-usuariossa')
                                                    <form method="POST" action="{{ route('usuariossa.destroy', $usuario->id) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item"><i class="icon-cross2 text-danger"></i> Deletar</button>
                                                    </form>
                                                    @endpermission
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan=7>
                                    @php
                                        if(request()->name){
                                            $url = '&name='.request()->name;
                                        }else{
                                            $url='';
                                        }
                                    @endphp
                                    <ul class="pagination pagination-pager pagination-rounded justify-content-center">
                                        @if ($usuarios->previousPageUrl())
                                            <li class="page-item"><a href="{{ $usuarios->previousPageUrl() }}{{ $url }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if (!$usuarios->previousPageUrl())
                                            <li class="page-item disabled"><a href="{{ $usuarios->previousPageUrl() }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if ($usuarios->nextPageUrl())
                                            <li class="page-item"><a href="{{ $usuarios->nextPageUrl() }}{{ $url }}" class="page-link">Próximo &nbsp; →</a></li>
                                        @endif
                                        @if (!$usuarios->nextPageUrl())
                                            <li class="page-item disabled"><a href="{{ $usuarios->nextPageUrl() }}" class="page-link">Próximo &nbsp; →</a></li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            <!--Ticket Termina aqui-->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /support tickets -->
        </div>
    </div>
@endsection
