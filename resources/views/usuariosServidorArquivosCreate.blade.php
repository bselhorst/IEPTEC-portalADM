@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Usuários do Servidor de Arquivos</span> - Cadastrar
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('usuariossa.index') }}" class="breadcrumb-item"><i class="icon-users mr-2"></i> Usuarios do servidor de arquivos</a>
<span class="breadcrumb-item active">Cadastrar</span>
@endsection

@section('content')

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Cadastrar Chamados</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ route('usuariossa.store') }}">
            @csrf
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados do chamado</legend>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Setor <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="setor_id" id="setor_id" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                @if (count($setores) == 0)
                                    <option value="">Não há nenhum setor a ser selecionado</option>
                                @else
                                <option value="">Selecione um Setor</option>
                                @endif
                                @foreach ($setores as $setor)
                                    <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Tipo <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="tipo" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                <option value="">Seleciona um Tipo</option>                              
                                <option value="Bolsista">Bolsista</option>                              
                                <option value="CEC">CEC</option>                              
                                <option value="Servidor Efetivo">Servidor Efetivo</option>                              
                                <option value="Terceirizado">Terceirizado</option>                              
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Colaborador <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="colaborador" class="form-control" required placeholder="Nome do Colaborador">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Login <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="login" class="form-control" required placeholder="Login">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Status <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="status" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                <option value="Ativo">Ativo</option>                              
                                <option value="Inativo">Inativo</option>                                                           
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Acesso <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control multiselect" multiple="multiple" name="acesso[]">
                                @foreach ($folders as $folder)
                                    <option value="{{ $folder->id }}">{{ $folder->nome }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="d-flex justify-content-end align-items-center">
                <button type="reset" class="btn btn-light" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button>
                <button type="submit" class="btn btn-primary ml-3">Cadastrar <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- /form validation -->
@endsection