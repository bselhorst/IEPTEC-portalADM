@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Patrimônio</span> - Cadastrar
@endsection

@section('page-title-buttons')
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('patrimonio.index') }}" class="breadcrumb-item"><i class="icon-barcode2 mr-2"></i> Patrimonio</a>
<span class="breadcrumb-item active">{{ @$data ? 'Editar' : 'Cadastrar' }}</span>
@endsection

@section('content')
<script src="{{ asset('backend/assets/js/jquery.mask.js') }}" type="text/javascript"></script>

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ @$data ? 'Editar Cadastro' : 'Cadastrar Patrimônio' }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ @$data ? route('patrimonio.update', $data->id) : route('patrimonio.store') }}">
            @csrf
            @if (@$data)
                @method('PATCH')
            @endif
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados Gerais</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Bem<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <select class="class-form select-search select2-hidden-accessible" name="bem_id" required>
                            <option value="">Selecione uma opção </option>
                            @foreach ($bens as $bem)
                                <option value="{{ @$bem->id }}" {{ @$data->bem_id == $bem->id ? 'SELECTED':'' }}>{{ $bem->descricao." ".$bem->marca." ".$bem->modelo." ".$bem->cor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Situação<span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <select class="class-form select" name="situacao_id">
                            <option value="">Selecione uma opção</option>
                            @foreach ($situacoes as $situacao)
                                <option value="{{ @$situacao->id }}" {{ @$data->situacao_id == $situacao->id ? 'SELECTED':'' }}>{{ $situacao->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Número do Patrimônio da SEE</label>
                    <div class="col-lg-2">
                        <input type="text" name="numero_pat_see" class="form-control" placeholder="" value="{{ @$data->numero_pat_see }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Número do Patrimônio Interno</label>
                    <div class="col-lg-2">
                        <input type="text" name="numero_pat_interno" class="form-control" placeholder="" value="{{ @$data->numero_pat_interno }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Número do Patrimônio do IEPTEC</label>
                    <div class="col-lg-2">
                        <input type="text" name="numero_pat_ieptec" class="form-control" placeholder="" value="{{ @$data->numero_pat_ieptec }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Origem<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <select class="class-form select-search select2-hidden-accessible" name="setor_origem_id">
                            <option value="">Selecione uma opção</option>
                            @foreach ($setores as $setor)
                                <option value="{{ $setor->id }}" {{ @$data->setor_origem_id == $setor->id ? 'SELECTED':'' }}>{{ $setor->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Locado<span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <select class="form-control select" name="locado">
                            <option value="">Selecione uma opção</option>
                            <option value="Sim" {{ @$data->locado == 'Sim' ? 'SELECTED':'' }}>Sim</option>
                            <option value="Não" {{ @$data->locado == 'Não' ? 'SELECTED':'' }}>Não</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Destino<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <select class="class-form select-search select2-hidden-accessible" name="setor_destino_id">
                            <option value="">Selecione uma opção</option>
                            @foreach ($setores as $setor)
                                <option value="{{ $setor->id }}" {{ @$data->setor_destino_id == $setor->id ? 'SELECTED':'' }}>{{ $setor->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Local Específico</label>
                    <div class="col-lg-4">
                        <input type="text" name="loca_especifico" class="form-control" placeholder="" value="{{ @$data->numero_pat_see }}">
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
