@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Pessoas</span> - Cadastrar
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('pessoas.index') }}" class="breadcrumb-item"><i class="icon-users mr-2"></i> Pessoas</a>
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
        <form class="form-validate-jquery" method="POST" action="{{ route('pessoas.store') }}">
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
                    <label class="col-form-label col-lg-3">Tipo de Contrato <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="tipo_contrato_id" id="tipo_contrato_id" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                @if (count($tiposContratos) == 0)
                                    <option value="">Não há nenhum tipo de contrato</option>
                                @else
                                <option value="">Selecione um Setor</option>
                                @endif
                                @foreach ($tiposContratos as $tipoContrato)
                                    <option value="{{ $tipoContrato->id }}">{{ $tipoContrato->tipo_contrato }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Função <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="funcao_id" id="funcao_id" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                @if (count($funcoes) == 0)
                                    <option value="">Não há nenhuma função</option>
                                @else
                                <option value="">Selecione um Setor</option>
                                @endif
                                @foreach ($funcoes as $funcao)
                                    <option value="{{ $funcao->id }}">{{ $funcao->funcao }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Nome <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="nome" class="form-control" required placeholder="Nome">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Origem <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="origem" class="form-control" required placeholder="Órgão de Origem">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Telefone <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="telefone" class="form-control" required placeholder="(XX)XXXXX-XXXX">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Email <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="email" class="form-control" required placeholder="Email">
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