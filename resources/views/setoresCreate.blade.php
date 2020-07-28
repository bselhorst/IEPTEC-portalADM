@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Setores</span> - Cadastrar
@endsection

@section('page-title-buttons')
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('setores.index') }}" class="breadcrumb-item"><i class="icon-office mr-2"></i> Setores</a>
<span class="breadcrumb-item active">Cadastrar</span>
@endsection

@section('content')

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Cadastrar Setores</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ route('setores.store') }}">
            @csrf
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados do Setor</legend>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Nome <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="nome" class="form-control" required placeholder="Nome do Setor">
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