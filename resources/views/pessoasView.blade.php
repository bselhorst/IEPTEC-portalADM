@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Pessoas</span> - Visualizar
@endsection

@section('page-title-buttons')
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('pessoas.index') }}" class="breadcrumb-item"><i class="icon-users mr-2"></i> Pessoas</a>
<span class="breadcrumb-item active"><i class="icon-eye mr-2"></i> Visualizar</span>
@endsection

@section('content')
<script src="{{ asset('backend/assets/js/jquery.mask.js') }}" type="text/javascript"></script>

@if (\Session::has('success'))
    <div class="alert alert-success bg-white alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <h6 class="alert-heading font-weight-semibold mb-1">Sucesso</h6>
        {!!\Session::get('success')!!}
    </div>
@endif

<!-- Invoice template -->
<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <h6 class="card-title">Dados da Pessoa</h6>
        <div class="header-elements">
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-4">
                     <ul class="list list-unstyled mb-0">
                        <li><h3 class="my-2">{{ $data->nome }}</h3></li>
                        <li><span class="font-weight-semibold">Filiação: </span> {{ $data->filiacao1 }}</li>
                        <li><span class="font-weight-semibold">Filiação: </span> {{ $data->filiacao2 }}</li>
                        <li>{{ $data->telefone }}</li>
                        <li>{{ $data->celular }}</li>
                        <li><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="d-md-flex flex-md-wrap">
            <div class="mb-4 mb-md-2">
                <span class="text-muted"><h3 class="my-2">Documentos</h3></span>
                 <ul class="list list-unstyled mb-0">
                    <li><span class="font-weight-semibold">RG: </span>{{ $data->rg }}</li>
                    <li><span class="font-weight-semibold">CPF: </span>{{ $data->cpf }}</li>
                    <li><span class="font-weight-semibold">Sexo: </span>{{ $data->sexo }}</li>
                    <li><span class="font-weight-semibold">Data de Nascimento: </span>{{ date('d/m/Y', strtotime($data->dataNascimento)) }}</li>
                </ul>
            </div>
        </div>
        <div class="d-md-flex flex-md-wrap">
            <div class="mb-4 mb-md-2">
                <span class="text-muted"><h3 class="my-2">Endereço</h3></span>
                 <ul class="list list-unstyled mb-0">
                    <li><span class="font-weight-semibold">Endereço: </span>{{ $data->rua }} {{ @$data->numero }}</li>
                    <li><span class="font-weight-semibold">Bairro: </span>{{ $data->bairro }}</li>
                    <li><span class="font-weight-semibold">Município: </span>{{ $data->municipio }}</li>
                    <li><span class="font-weight-semibold">CEP: </span>{{ $data->cep }}</li>
                    @if ($data->complemento)
                        <li><span class="font-weight-semibold">Complemento: </span>{{ $data->complemento }}</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="d-md-flex flex-md-wrap">
            <div class="mb-4 mb-md-2">
                <span class="text-muted"><h3 class="my-2">Contato de Emergência</h3></span>
                 <ul class="list list-unstyled mb-0">
                    <li><span class="font-weight-semibold">Nome: </span>{{ $data->nomeDeEmergencia }}</li>
                    <li><span class="font-weight-semibold">Número: </span>{{ $data->numeroEmergencia }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-lg">
            <thead>
                <tr>
                    <th colspan="6" style="font-size: 22px; text-align: center">Contratos <a href="{{ route("contratos.create", $data->id) }}"><i class="icon-add"></i></a></th>
                </tr>
            </thead>
            <tr>
                <th>Termo/Portaria</th>
                <th>Data Nomeação</th>
                <th>Data da Renovação</th>
                <th>Data da Exoneração</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <tbody>
                @foreach ($contracts as $item)
                    <tr>
                        <td>{{ $item->termo_portaria }}</td>
                        <td>{{ ($item->data_nomeacao) ? date('d/m/Y', strtotime($item->data_nomeacao)) : '-' }}</td>
                        <td>{{ ($item->data_renovacao) ? date('d/m/Y', strtotime($item->data_renovacao)) : '-' }}</td>
                        <td>{{ ($item->data_exoneracao) ? date('d/m/Y', strtotime($item->data_exoneracao)) : '-' }}</td>
                        <td>
                            <div class="font-weight-semibold">
                                <span class="badge {{ ($item->status == 1) ? 'badge-success' : 'badge-danger' }}">{{ ($item->status == 1) ? 'ATIVO' : 'INATIVO' }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('contratos.edit', [$data->id, $item->id]) }}" class="dropdown-item"><i class="icon-pencil"></i> Editar</a>
                                        <button class="dropdown-item"><i class="icon-alarm-add text-success"></i>Renovar Contrato</button>
                                        <button class="dropdown-item" onclick="modal({{ $data->id }},{{ $item->id }})"><i class="{{ ($item->status == 0)? 'icon-check text-success' : 'icon-close2 text-danger'}}"></i>{{ ($item->status == 1)? 'Desativar ' : 'Ativar ' }}Contrato</button>
                                        <form method="POST" action="{{ route('contratos.showdestroy', [$data->id, $item->id]) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item"><i class="icon-cross2 text-danger"></i> Deletar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <span class="text-muted">As informações encontradas aqui podem sofrer alterações no decorrer do uso do sistema</span>
    </div>
</div>

<!-- /invoice template -->

<script>
    function modal(pessoa_id, id){
        $('#formUpdate').attr('action', 'contratos/'+id+'/updateContratoShow');
        $('#modal_update').modal('show');
    }
</script>

<!-- Horizontal form modal -->
<div id="modal_update" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="#" id="formUpdate" method="POST" class="form-validate-jquery">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                    <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body">Deseja alterar o status do contrato?</div>
                </div>
                <div class="modal-footer">
                    <button data-bb-handler="cancel" type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                    <button data-bb-handler="confirm" type="submit" class="btn btn-primary">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
