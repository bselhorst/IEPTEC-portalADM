@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Chamados</span> - Finalizar
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
@endsection

@section('breadcrumb')
<a href="../../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('chamados.index') }}" class="breadcrumb-item"><i class="icon-ticket mr-2"></i> Chamados</a>
<span class="breadcrumb-item active">Finalizar</span>
@endsection

@section('content')

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Finalizar Chamados</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ route('chamados.finish', $chamado->id) }}">
            @csrf
            @method('PATCH')
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados do chamado</legend>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Categoria</label>
                    <div class="col-lg-9" style="padding-top: 8px">
                        {{$categoria->categoria}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Descrição</label>
                    <div class="col-lg-9" style="padding-top: 8px; text-align: justify">
                        {{$chamado->descricao}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Técnico <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control select-search select2-hidden-accessible" name="user_id" id="user_id" data-fouc="" tabindex="-1" aria-hidden="true" required>
                            @if (count($tecnicos) == 0)
                                <option value="">Não há nenhum usuário a ser adicionado</option>
                            @else
                            <option value="">Selecione um Técnico</option>
                            @endif
                            @foreach ($tecnicos as $tecnico)
                                <option value="{{ $tecnico->id }}" {{ ($tecnico->id==$chamado->user_id) ? 'selected' : '' }}>{{ $tecnico->name }}</option>
                            @endforeach                                
                        </select>
                    </div>
                </div>
                <div class="form-group row">
					<label class="col-form-label col-lg-3">Solução <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<textarea rows="5" cols="5" name="solucao" class="form-control" required placeholder="Descrição da Solução"></textarea>
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