@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Contratos - {{ @$data_person['nome'] }} <a href="{{ route("pessoas.show", $data_person['id']) }}"><i class="icon-eye"></i></a></span>
@endsection

@section('page-title-buttons')
{{-- <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> --}}
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="/pessoas" class="breadcrumb-item"><i class="icon-users mr-2"></i> Pessoas</a>
<a href="#" class="breadcrumb-item active"><i class="icon-file-text2 mr-2"></i> Contratos</a>
@endsection

@section('content')

    @if (\Session::has('success'))
        <div class="alert alert-success bg-white alert-styled-left alert-arrow-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <h6 class="alert-heading font-weight-semibold mb-1">Sucesso</h6>
            {!!\Session::get('success')!!}
        </div>
    @endif

    <!-- Form validation -->
    <!--
    <div class="card">
        <div class="card-body">
            <form class="form-validate-jquery" method="GET" action="/pessoas/search">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Pesquisar</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Nome Completo<span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" placeholder="Nome Completo">
                        </div>
                    </div>
                </fieldset>
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary ml-3">Pesquisar <i class="icon-search4 ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    -->
    <div class="row">
        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click" data-fab-state="closed">
            <li>
                <a href="#" class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
                    <i class="fab-icon-open icon-paragraph-justify3"></i>
                    <i class="fab-icon-close icon-cross2"></i>
                </a>

                <ul class="fab-menu-inner">
                    {{-- @role('mediador') --}}
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('contratos.create', $pessoa_id) }}" class="btn btn-light rounded-round btn-icon btn-float">
                                <i class="icon-plus2"></i>
                            </a>
                        </div>
                    </li>
                    {{-- @endrole --}}
                </ul>
            </li>
        </ul>
        <div class="col-xl-12">
            <!-- Support tickets -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th colspan="3">Tabela de Pessoas</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td>Termo/Portaria</td>
                                <td>Data Nomeação</td>
                                <td>Renovado?</td>
                                <td>Data da Renovação</td>
                                <td>Data Exoneração</td>
                                <td>Status</td>
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{$data->total()}}</span>
                                </td>
                            </tr>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        <div class="font-weight-semibold">
                                            {{ $item->termo_portaria }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">
                                            {{ date('d/m/Y', strtotime($item->data_nomeacao)) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">
                                            {{  ($item->renovacao == 'SIM') ? $item->renovacao : 'NÃO' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">
                                            {{ ($item->data_renovacao) ? date('d/m/Y', strtotime($item->data_renovacao)) : '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">
                                            {{
                                                ($item->data_nova_exoneracao) ? date('d/m/Y', strtotime($item->data_nova_exoneracao)) : (($item->data_exoneracao) ? date('d/m/Y', strtotime($item->data_exoneracao)) : '-')
                                            }}
                                        </div>
                                    </td>
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
                                                    <a href="{{ route('contratos.edit', [$pessoa_id, $item->id]) }}" class="dropdown-item"><i class="icon-pencil"></i> Editar</a>
                                                    <button class="dropdown-item" onclick="modalRenovarContrato({{ $pessoa_id }},{{ $item->id }})"><i class="icon-alarm-add text-success"></i>Renovar Contrato</button>
                                                    <button class="dropdown-item" onclick="modal({{ $pessoa_id }},{{ $item->id }})"><i class="{{ ($item->status == 0)? 'icon-check text-success' : 'icon-close2 text-danger'}}"></i>{{ ($item->status == 1)? 'Desativar ' : 'Ativar ' }}Contrato</button>
                                                    <form method="POST" action="{{ route('contratos.destroy', [$pessoa_id, $item->id]) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
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
                            <tr class="">
                                <td colspan="7">
                                    @php
                                        if(request()->name){
                                            $url = '&name='.request()->name;
                                        }else{
                                            $url='';
                                        }
                                    @endphp
                                    <ul class="pagination pagination-pager pagination-rounded justify-content-center">
                                        @if ($data->previousPageUrl())
                                    <li class="page-item"><a href="{{ $data->previousPageUrl() }}{{ $url }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if (!$data->previousPageUrl())
                                            <li class="page-item disabled"><a href="{{ $data->previousPageUrl() }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if ($data->nextPageUrl())
                                            <li class="page-item"><a href="{{ $data->nextPageUrl() }}{{ $url }}" class="page-link">Próximo &nbsp; →</a></li>
                                        @endif
                                        @if (!$data->nextPageUrl())
                                            <li class="page-item disabled"><a href="{{ $data->nextPageUrl() }}" class="page-link">Próximo &nbsp; →</a></li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function modal(pessoa_id, id){
            $('#formStatusContrato').attr('action', 'contratos/'+id+'/updateContrato');
            $('#modalStatusContrato').modal('show');
        }

        function modalRenovarContrato(pessoa_id, id){
            // document.getElementById('pessoa_id').value = pessoa_id;
            document.getElementById('data_renovacao').value = null;
            document.getElementById('data_final').value = null;
            document.getElementById("btnConfirmaRenovacao").disabled = true;
            $('#formRenovarContrato').attr('action', 'contratos/'+id+'/renovarContrato');
            $('#modalRenovarContrato').modal('show');
        }

        function activeButton(){
            data_renovacao = document.getElementById('data_renovacao').value;
            data_final = document.getElementById('data_final').value;
            if(data_renovacao && data_final){
                document.getElementById("btnConfirmaRenovacao").disabled = false;
            }else{
                document.getElementById("btnConfirmaRenovacao").disabled = true;
            }
        }
    </script>

    <!-- Horizontal form modal -->
    <div id="modalStatusContrato" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="#" id="formStatusContrato" method="POST" class="form-validate-jquery">
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

    <!-- Horizontal form modal -->
    <div id="modalRenovarContrato" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" id="formRenovarContrato" method="POST" class="form-validate-jquery">
                    {{-- <input type="hidden" name="pessoa_id" /> --}}
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação de Renovação</h5>
                        <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body">Data de renovação</div>
                        <input type="date" name="data_renovacao" id="data_renovacao" onchange="activeButton()" class="form-control" autocomplete="off" value="" required>
                        <br>
                        <div class="bootbox-body">Nova data final</div>
                        <input type="date" name="data_nova_exoneracao" id="data_final" onchange="activeButton()" class="form-control" autocomplete="off" value="" required>
                    </div>
                    <div class="modal-footer">
                        <button data-bb-handler="cancel" type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                        <button data-bb-handler="confirm" type="submit" id="btnConfirmaRenovacao" class="btn btn-primary">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
