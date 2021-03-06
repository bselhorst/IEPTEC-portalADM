@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Técnicos</span> - Cadastrar
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('tecnicos.index') }}" class="breadcrumb-item"><i class="icon-users mr-2"></i> Técnicos</a>
<span class="breadcrumb-item active">Cadastrar</span>
@endsection

@section('content')

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Cadastrar Técnicos</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ route('tecnicos.store') }}">
            @csrf
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Nome do Técnico</legend>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Nome <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="user_id" id="user_id" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                @if (count($users) == 0)
                                    <option value="">Não há nenhum usuário a ser adicionado</option>
                                @else
                                <option value="">Selecione um Técnico</option>
                                @endif
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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