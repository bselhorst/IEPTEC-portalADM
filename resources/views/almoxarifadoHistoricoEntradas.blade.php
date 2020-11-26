@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Almoxarifado</span>
@endsection

@section('page-title-buttons')
<!--<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>-->
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{route('almoxarifado.index')}}" class="breadcrumb-item"><i class="icon-price-tags2 mr-2"></i> Almoxarifado</a>
<a href="#" class="breadcrumb-item active"><i class="icon-history mr-2"></i> Histórico de Entradas</a>
@endsection

@section('content')
    <!-- Form validation -->

    <script src="{{ asset('backend/assets/js/jquery-maskmoney.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $('#valor_unitario').maskMoney();
            $('#valor_total').maskMoney();
        })
    </script>

    {{-- <div class="card">
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
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary ml-3">Pesquisar <i class="icon-search4 ml-2"></i></button>
                </div>
            </form>
        </div>
    </div> --}}

    <div class="row">
        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click" data-fab-state="closed">
            <li>
                <a href="#" class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
                    <i class="fab-icon-open icon-paragraph-justify3"></i>
                    <i class="fab-icon-close icon-cross2"></i>
                </a>

                <ul class="fab-menu-inner">
                    @role('patrimonio')
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('almoxarifado.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
                                <i class="icon-plus2"></i>
                            </a>
                        </div>
                    </li>
                    @endrole
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
                                <th>Histórico de Entrada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td>Fornecedor</td>
                                <td>Quantidade</td>
                                <td>Valor Unitário</td>
                                <td>Valor Total</td>
                                <td>Data</td>
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{$data->total()}}</span>
                                </td>
                            </tr>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->nome }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->quantidade }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">R$ {{ number_format($item->valor_unitario, 2, ",", ".") }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">R$ {{ number_format($item->valor_total, 2, ",", ".") }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->created_at }}</div>
                                    </td>
                                    <td class="text-right">
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    {{-- <a href="{{ route('almoxarifado.edit', $item->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Editar</a> --}}

                                                    {{-- <a href="{{ route('almoxarifado.cancelarEntrada', $item->id) }}" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Cancelar Entrada</a> --}}

                                                    <form method="POST" action="{{ route('almoxarifado.cancelarEntrada', $item->id) }}" onsubmit="return confirm('Deseja cancelar esse registro?')">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="dropdown-item"><i class="icon-cross2 text-danger"></i> Cancelar Entrada</button>
                                                    </form>

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
@endsection
