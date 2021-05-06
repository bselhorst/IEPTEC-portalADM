@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Setores</span>
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('setores.index') }}" class="breadcrumb-item active"><i class="icon-library2 mr-2"></i> Setores</a>
@endsection

@section('content')
    <div class="row">
        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click" data-fab-state="closed">
            <li>
                <a href="#" class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
                    <i class="fab-icon-open icon-paragraph-justify3"></i>
                    <i class="fab-icon-close icon-cross2"></i>
                </a>

                <ul class="fab-menu-inner">
                    @permission('create-aux-tecnologia')
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('setores.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
                                <i class="icon-plus2"></i>
                            </a>
                        </div>
                    </li>
                    @endpermission
                    <li>
                        <div data-fab-label="Dashboard">
                            <a href="#" class="btn btn-light rounded-round btn-icon btn-float">
                                <i class="icon-bars-alt"></i>
                            </a>
                        </div>
                    </li>
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
                                <th>Nome</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td colspan="1">Lista de Setores</td>
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{$setoresTotal->count()}}</span>
                                </td>
                            </tr>
                            @foreach($setores as $setor)
                                <tr>
                                    <td>
                                        <div class="font-weight-semibold">{{ $setor->nome }}</div>
                                    </td>
                                    <td class="text-center">
                                        @permission('delete-aux-tecnologia')
                                        <form method="POST" action="{{ route('setores.destroy', $setor->id) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item"><i class="icon-cross2 text-danger"></i> Deletar</button>
                                        </form>
                                        @endpermission
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan=4>
                                    <ul class="pagination pagination-pager pagination-rounded justify-content-center">
                                        @if ($setores->previousPageUrl())
                                            <li class="page-item"><a href="{{ $setores->previousPageUrl() }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if (!$setores->previousPageUrl())
                                            <li class="page-item disabled"><a href="{{ $setores->previousPageUrl() }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if ($setores->nextPageUrl())
                                            <li class="page-item"><a href="{{ $setores->nextPageUrl() }}" class="page-link">Próximo &nbsp; →</a></li>
                                        @endif
                                        @if (!$setores->nextPageUrl())
                                            <li class="page-item disabled"><a href="{{ $setores->nextPageUrl() }}" class="page-link">Próximo &nbsp; →</a></li>
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
