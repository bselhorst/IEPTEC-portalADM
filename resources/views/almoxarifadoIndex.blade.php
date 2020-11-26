@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Almoxarifado</span>
@endsection

@section('page-title-buttons')
<!--<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>-->
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="#" class="breadcrumb-item active"><i class="icon-price-tags2 mr-2"></i> Almoxarifado</a>
@endsection

@section('content')
    <script src="{{ asset('backend/assets/js/jquery-maskmoney.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $('#valor_unitario').maskMoney();
            $('#valor_total').maskMoney();
        })
    </script>
    <!-- Form validation -->
    <div class="card">
        <div class="card-body">
            <form class="form-validate-jquery" method="GET" action="/almoxarifado/search">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Pesquisar</legend>
                    <div class="form-group row">
                        <div class="col-lg-4"></div>
                        <label class="col-form-label col-lg-1">Procurar por<span class="text-danger"></span></label>
                        <div class="col-lg-3">
                            <input type="text" name="pesquisa" class="form-control" placeholder="Descrição ou Código">
                        </div>
                    </div>
                </fieldset>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary ml-3">Pesquisar <i class="icon-search4 ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click" data-fab-state="closed">
            <li>
                <a href="#" class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
                    <i class="fab-icon-open icon-paragraph-justify3"></i>
                    <i class="fab-icon-close icon-cross2"></i>
                </a>

                <ul class="fab-menu-inner">
                    {{-- @role('almoxarifado') --}}
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('almoxarifado.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
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
                                <th>Tabela de Itens</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td>Descrição</td>
                                <td>Código</td>
                                <td>Unidade</td>
                                <td>Estoque Mínimo</td>
                                <td>Saldo</td>
                                <td>Status</td>
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{$data->total()}}</span>
                                </td>
                            </tr>
                            @foreach($data as $item)
                                <tr
                                @if ($item->saldo == 0)
                                    class="alpha-danger"
                                    {{$status = 'Sem Estoque'}}
                                @else
                                    @if($item->saldo >= $item->estoque_minimo)
                                        class="alpha-success"
                                        {{$status = 'Estoque Confortável'}}
                                    @else
                                        class="alpha-orange"
                                        {{$status = 'Necessita de Abastecimento'}}
                                    @endif
                                @endif
                                >
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->descricao }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->codigo }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->unidade }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->estoque_minimo }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->saldo }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $status }}</div>
                                    </td>
                                    <td class="text-right">
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a href="{{ route('almoxarifado.edit', $item->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Editar</a>

                                                    <form method="POST" action="{{ route('almoxarifado.destroy', $item->id) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item"><i class="icon-cross2 text-danger"></i> Deletar</button>
                                                    </form>

                                                    <button class="dropdown-item" onclick="modal({{ $item->id }})"><i class="icon-box-add"></i> Adicionar Saldo</button>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan=7>
                                    @php
                                        $url = '';
                                        request()->pesquisa? $url.='&pesquisa='.request()->pesquisa : '';
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
        function modal(id){
            $('#formAddSaldo').attr('action', '/almoxarifado/'+id+'/entrada');
            $('#modal_add_saldo').modal('show');
        }
    </script>

    <!-- Horizontal form modal -->
    <div id="modal_add_saldo" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title">Adicionar no Estoque</h6>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- route('usuarios.updatePassword', 0) -->
                <form action="#" id="formAddSaldo" method="POST" class="form-validate-jquery">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Fornecedor</label>
                            <div class="col-sm-9">
                                <select class="form-control select-search select2-hidden-accessible" name="fornecedor_id" id="fornecedor_id" aria-hidden="true" required>
                                    @if (count($fornecedores) == 0)
                                        <option value="">Sem Registros</option>
                                    @else
                                    <option value="">Selecione um Fornecedor</option>
                                    @endif
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Quantidade</label>
                            <div class="col-sm-9">
                                <input type="number" name="quantidade" id="quantidade" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Preço Unitário</label>
                            <div class="col-sm-9">
                                <input type="text" name="valor_unitario" id="valor_unitario" data-prefix="R$ " data-thousands="." data-decimal="," class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Preço Total</label>
                            <div class="col-sm-9">
                                <input type="text" name="valor_total" id="valor_total" data-prefix="R$ " data-thousands="." data-decimal="," class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal" style="align: left">Fechar</button>
                        <button type="submit" class="btn bg-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /horizontal form modal -->
@endsection
