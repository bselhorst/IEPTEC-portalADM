@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Almoxarifado</span> - {{ (@$data) ? 'Editar' : 'Cadastrar' }}
@endsection

@section('page-title-buttons')
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('almoxarifado.index') }}" class="breadcrumb-item"><i class="icon-price-tags2 mr-2"></i> Almoxarifado</a>
<span class="breadcrumb-item active">{{ (@$data) ? 'Editar' : 'Cadastrar' }}</span>
@endsection

@section('content')

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ (@$data) ? 'Editar' : 'Cadastrar' }} Item</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ (@$data)? route('almoxarifado.update', $data->id) : route('almoxarifado.store') }}">
            @csrf
            @if(@$data)
                @method('PATCH')
            @endif
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados do item</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Código <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="text" name="codigo" class="form-control" placeholder="Código" value="{{ (@$data) ? $data->codigo : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Descricao <span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" name="descricao" class="form-control" required placeholder="Descrição" autocomplete="off" value="{{ (@$data) ? $data->descricao : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Unidade <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <select class="form-control select-search select2-hidden-accessible" name="unidade_id" id="unidade_id" tabindex="-1" aria-hidden="true" required>
                            @if (count($unidades) == 0)
                                <option value="">Sem Tipos de Unidades</option>
                            @else
                            <option value="">Selecione uma Unidade</option>
                            @endif
                            @foreach ($unidades as $unidade)
                                <option value="{{ $unidade->id }}" {{ (@$data->unidade_id == $unidade->id) ? 'selected' : '' }}>{{ $unidade->descricao."(".$unidade->unidade.")" }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Estoque Mínimo <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="number" name="estoque_minimo" class="form-control" placeholder="Ex: 15" step=".01" value="{{ (@$data) ? $data->estoque_minimo : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Saldo <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="number" name="saldo" class="form-control" placeholder="ex: 20" step=".01" value="{{ (@$data) ? $data->saldo : '' }}" required>
                    </div>
                </div>
            </fieldset>

            <div class="d-flex justify-content-end align-items-center">
                <button type="reset" class="btn btn-light" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button>
                <button type="submit" class="btn btn-primary ml-3">{{ (@$data) ? 'Editar' : 'Cadastrar' }} <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- /form validation -->
@endsection
