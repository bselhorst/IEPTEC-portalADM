@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Chamados</span> - Editar
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
@endsection

@section('breadcrumb')
<a href="../../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('chamados.index') }}" class="breadcrumb-item"><i class="icon-ticket mr-2"></i> Chamados</a>
<span class="breadcrumb-item active">Editar</span>
@endsection

@section('content')

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Editar Chamado</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ route('chamados.update', $chamado->id) }}">
            @csrf
            @method('PATCH')
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados do Chamado</legend>
                <!--<div class="form-group row">
                    <label class="col-form-label col-lg-3">Título <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="titulo" class="form-control" required placeholder="Text input validation" value="{{$chamado->titulo}}">
                    </div>
                </div>-->
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Categoria <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="categoria_id" id="categoria_id" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                @if (count($categorias) == 0)
                                    <option value="">Não há nenhuma categoria a ser selecionado</option>
                                @else
                                <option value="">Selecione uma Categoria</option>
                                @endif
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ ($categoria->id == $chamado->categoria_id)? 'selected':'' }}>{{ $categoria->categoria }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
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
                                    <option value="{{ $setor->id }}" {{ ($setor->id == $chamado->setor_id)? 'selected' : '' }}>{{ $setor->nome }}</option>                                 
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Solicitante <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="solicitante" class="form-control" required placeholder="Nome do Solicitante" value="{{$chamado->solicitante}}">
                    </div>
                </div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Descrição <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<textarea rows="5" cols="5" name="descricao" class="form-control" required placeholder="Default textarea">{{$chamado->descricao}}</textarea>
					</div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">Técnico <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select class="form-control select-search select2-hidden-accessible" name="user_id" id="user_id" data-fouc="" tabindex="-1" aria-hidden="true" required>
                                @if (count($users) == 0)
                                    <option value="">Não há nenhum usuário a ser adicionado</option>
                                @else
                                <option value="">Selecione um Técnico</option>
                                @endif
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ ($user->id == $chamado->user_id)? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="d-flex justify-content-end align-items-center">
                <button type="reset" class="btn btn-light" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button>
                <button type="submit" class="btn btn-primary ml-3">Editar <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- /form validation -->
@endsection
