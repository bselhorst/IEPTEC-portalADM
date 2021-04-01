@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Patrimônio</span>
@endsection

@section('page-title-buttons')
{{-- <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> --}}
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="#" class="breadcrumb-item active"><i class="icon-barcode2 mr-2"></i> Patrimonio</a>
@endsection

@section('content')

    <!-- Form validation -->
    <div class="card">
        <div class="card-body">
            <form class="form-validate-jquery" method="GET" action="/patrimonio/search">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Pesquisar</legend>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <label class="col-form-label col-lg-2">Descrição<span class="text-danger">*</span></label>
                        <div class="col-lg-4">
                            <input type="text" name="descricao" class="form-control" placeholder="Descrição">
                        </div>
                    </div>
                </fieldset>
                <div class="d-flex justify-content-end align-items-center">
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
                    {{-- @role('mediador') --}}
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('patrimonio.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
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
                                <th>Tabela de Pessoas</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td>Item</td>
                                <td>Situação</td>
                                <td>Número Pat. SEE</td>
                                <td>Número Pat. Interno</td>
                                <td>Número Pat. IEPTEC</td>
                                {{-- <td>Origem</td>
                                <td>Locado</td>
                                <td>Destino</td>
                                <td>Local Específico</td> --}}
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{$data->total()}}</span>
                                </td>
                            </tr>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->bem." ".$item->marca." ".$item->modelo." ".$item->cor }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->situacao }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->numero_pat_see }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->numero_pat_interno }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->numero_pat_ieptec }}</div>
                                    </td>
                                    {{-- <td>
                                        <div class="font-weight-semibold">{{ $item->setor_origem }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->locado }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->setor_destino_id }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->local_especifico }}</div>
                                    </td> --}}

                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{ route('patrimonio.edit', $item->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Editar</a>
                                                    <form method="POST" action="{{ route('patrimonio.destroy', $item->id) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
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
                                <td colspan="10">
                                    @php
                                        if(request()->descricao){
                                            $url = '&descricao='.request()->descricao;
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
@endsection
