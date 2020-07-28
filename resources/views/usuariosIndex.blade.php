@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Usuários</span>
@endsection

@section('page-title-buttons')
<!--<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>-->
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('usuarios.index') }}" class="breadcrumb-item active"><i class="icon-users mr-2"></i> Usuários</a>
@endsection

@section('content')

    <!-- Form validation -->
<div class="card">
    <div class="card-body">
        <form class="form-validate-jquery" method="GET" action="/usuarios/search">
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Pesquisar</legend>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Nome Completo<span class="text-danger">*</span></label>
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
                    @permission('create-users')
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
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
                                <th>Nome</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td colspan="1">Lista de Usuários</td>
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{$usuarios->total()}}</span>
                                </td>
                            </tr>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>
                                        <div class="font-weight-semibold">{{ $usuario->name }} ({{ $usuario->email }})</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @role('usuarios')
                                            <button class="dropdown-item" onclick="window.open('/laratrust/roles-assignment/{{$usuario->id}}/edit?model=users', '_blank')"><i class="icon-cogs"></i> Permissões</button>
                                            @endrole
                                            <button class="dropdown-item" onclick="modal({{ $usuario->id }})"><i class="icon-eraser"></i> Redefinir Senha</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan=4>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function modal(id){
            $('#formResetPassword').attr('action', '/usuarios/'+id+'/updatePassword');
            $('#modal_reset_password').modal('show');
        }
    </script>

    <!-- Horizontal form modal -->
    <div id="modal_reset_password" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulário de Redefinição de Senha </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('usuarios.updatePassword', 0) }}" id="formResetPassword" method="POST" class="form-validate-jquery">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Password</label>
                            <div class="col-sm-9">
                                <input type="text" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal" style="align: left">fechar</button>
                        <button type="submit" class="btn bg-primary">Redefinir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /horizontal form modal -->
@endsection