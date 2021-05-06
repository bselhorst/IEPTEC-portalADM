@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Pessoas</span> - Cadastrar
@endsection

@section('page-title-buttons')
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('pessoas.index') }}" class="breadcrumb-item"><i class="icon-users mr-2"></i> Pessoas</a>
<span class="breadcrumb-item active">{{ @$data ? 'Editar' : 'Cadastrar' }}</span>
@endsection

@section('content')
<script src="{{ asset('backend/assets/js/jquery.mask.js') }}" type="text/javascript"></script>

<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ @$data ? 'Editar Cadastro' : 'Cadastrar Pessoa' }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form class="form-validate-jquery" method="POST" action="{{ @$data ? route('pessoas.update', $data->id) : route('pessoas.store') }}">
            @csrf
            @if (@$data)
                @method('PATCH')
            @endif
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados Gerais</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Nome Completo<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" name="nome" class="form-control" required placeholder="Nome Completo (Sem abreviações)" value="{{ @$data->nome }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Filiação 1</label>
                    <div class="col-lg-4">
                        <input type="text" name="filiacao1" class="form-control" placeholder="Filiação" autocomplete="off" value="{{ @$data->filiacao1 }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Filiação 2</label>
                    <div class="col-lg-4">
                        <input type="text" name="filiacao2" class="form-control" placeholder="Filiação" autocomplete="off" value="{{ @$data->filiacao2 }}">
                    </div>
                </div>
                <legend class="text-uppercase font-size-sm font-weight-bold">Documentos</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">RG</label>
                    <div class="col-lg-4">
                        <input type="text" name="rg" class="form-control" placeholder="" autocomplete="off" value="{{ @$data->rg }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Órgão Exp.</span></label>
                    <div class="col-lg-4">
                        <input type="text" name="orgaoExp" class="form-control" placeholder="" autocomplete="off" value="{{ @$data->orgaoExp }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">CPF <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="text" name="cpf" class="form-control" data-mask="000.000.000-00" placeholder="___.___.___-__" autocomplete="off" value="{{ @$data->cpf }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Sexo <span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <select class="form-control select-search select2-hidden-accessible" name="sexo" id="sexo" tabindex="-1" aria-hidden="true" required>
                            <option value="">Selecione um valor</option>
                            <option value="Masculino" {{ @$data->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Feminino" {{ @$data->sexo == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                            <option value="Ignorar" {{ @$data->sexo == 'Ignorado' ? 'selected' : '' }}>Ignorar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Data de Nascimento <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="date" name="dataNascimento" class="form-control" value="{{ @$data->dataNascimento }}" autocomplete="off" required>
                    </div>
                </div>
                <legend class="text-uppercase font-size-sm font-weight-bold">Endereço</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Rua</label>
                    <div class="col-lg-4">
                        <input type="text" name="rua" class="form-control" placeholder="Rua" value="{{ @$data->rua }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Número</label>
                    <div class="col-lg-1">
                        <input type="text" name="numero" class="form-control" data-mask="00000" placeholder="" value="{{ @$data->numero }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Bairro</label>
                    <div class="col-lg-4">
                        <input type="text" name="bairro" class="form-control" placeholder="Bairro" value="{{ @$data->bairro }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Municipio</label>
                    <div class="col-lg-4">
                        <input type="text" name="municipio" class="form-control" placeholder="Municipio" value="{{ @$data->municipio }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Complemento</label>
                    <div class="col-lg-4">
                        <input type="text" name="complemento" class="form-control" placeholder="Complemento" value="{{ @$data->complemento }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Cep</label>
                    <div class="col-lg-2">
                        <input type="text" name="cep" class="form-control" data-mask="00000-000" placeholder="_____-___" value="{{ @$data->cep }}" autocomplete="off">
                    </div>
                </div>
                <legend class="text-uppercase font-size-sm font-weight-bold">Dados de Contato</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Telefone</label>
                    <div class="col-lg-2">
                        <input type="text" name="telefone" class="form-control" data-mask="(00)000000000" placeholder="(__)_________" value="{{ @$data->telefone }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Celular</label>
                    <div class="col-lg-2">
                        <input type="text" name="celular" class="form-control" data-mask="(00)000000000" placeholder="(__)_________" value="{{ @$data->celular }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Email</label>
                    <div class="col-lg-4">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ @$data->email }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Nome do contato de emergência</label>
                    <div class="col-lg-4">
                        <input type="text" name="nomeDeEmergencia" class="form-control" placeholder="Nome" value="{{ @$data->nomeDeEmergencia }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Contato de Emergência</label>
                    <div class="col-lg-2">
                        <input type="text" name="numeroEmergencia" class="form-control" data-mask="(00)000000000" data-mask-clearifnotmatch="true" value="{{ @$data->numeroEmergencia }}" placeholder="(__)_________" autocomplete="off">
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
