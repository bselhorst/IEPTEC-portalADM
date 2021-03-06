@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Modelos</span> - Cadastrar
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('marcas.index') }}" class="breadcrumb-item"><i class="icon-books mr-2"></i> Marcas</a>
<a href="{{ route('marcas.modelos', $marca->id) }}" class="breadcrumb-item">Modelos</a>
<span class="breadcrumb-item active">Cadastrar</span>
@endsection

@section('content')

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Cadastrar Modelos - {{$marca->marca}}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ route('modelos.store') }}">
            @csrf
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados do Modelo</legend>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Nome <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="modelo" class="form-control" required placeholder="Nome do modelo">
                    </div>
                </div>
                <input type="hidden" name="marca_id" class="form-control" value="{{ $marca->id }}">
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