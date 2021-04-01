@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Bem Patrimonial</span> - Cadastrar
@endsection

@section('page-title-buttons')
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('patrimoniobens.index') }}" class="breadcrumb-item"><i class="icon-bag mr-2"></i> Bem Patrimonial</a>
<span class="breadcrumb-item active">{{ @$data ? 'Editar' : 'Cadastrar' }}</span>
@endsection

@section('content')
<script src="{{ asset('backend/assets/js/jquery.mask.js') }}" type="text/javascript"></script>

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ @$data ? 'Editar Cadastro' : 'Cadastrar Bem Patrimonial' }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ @$data ? route('patrimoniobens.update', $data->id) : route('patrimoniobens.store') }}">
            @csrf
            @if (@$data)
                @method('PATCH')
            @endif
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados Gerais</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Descrição<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" name="descricao" class="form-control" required placeholder="Descrição do produto" value="{{ @$data->descricao }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Marca</label>
                    <div class="col-lg-4">
                        <input type="text" name="marca" class="form-control" placeholder="" autocomplete="off" value="{{ @$data->marca }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Modelo</label>
                    <div class="col-lg-4">
                        <input type="text" name="modelo" class="form-control" placeholder="" autocomplete="off" value="{{ @$data->modelo }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Cor</label>
                    <div class="col-lg-4">
                        <input type="text" name="cor" class="form-control" placeholder="Ex: Preto" autocomplete="off" value="{{ @$data->cor }}">
                    </div>
                </div>
            </fieldset>

            <div class="d-flex justify-content-end align-items-center">
                <button type="reset" class="btn btn-light" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button>
                <button type="submit" class="btn btn-primary ml-3">{{ @$data ? 'Editar' : 'Cadastrar' }} <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- /form validation -->
@endsection
