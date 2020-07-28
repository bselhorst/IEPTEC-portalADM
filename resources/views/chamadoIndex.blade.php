@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Chamados</span>
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('chamados.index') }}" class="breadcrumb-item active"><i class="icon-ticket mr-2"></i> Chamados</a>
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
                    @permission('create-chamados')
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('chamados.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
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
                                <th style="width: 50px">Tempo</th>
                                <th>Descrição</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td colspan="2">Chamados Ativos</td>
                                <td class="text-right">
                                    <span class="badge bg-blue badge-pill">{{$chamadosTotal->count()}}</span>
                                </td>
                            </tr>
    
                            <!--Ticket começa aqui-->
                            @foreach($chamados as $chamado)
                                <tr>
                                    <td class="text-center">
                                        <h6 class="mb-0">
                                            @php
                                                if(now()->diffInDays($chamado->created_at, false) != 0){
                                                    echo substr(now()->diffInDays($chamado->created_at, false), 1);
                                                }else if(now()->diffInHours($chamado->created_at, false) != 0){
                                                    echo substr(now()->diffInHours($chamado->created_at, false), 1);
                                                }else{
                                                    if(now()->diffInMinutes($chamado->created_at, false) != 0){
                                                        echo substr(now()->diffInMinutes($chamado->created_at, false), 1);
                                                    }else{
                                                        echo "0";
                                                    }
                                                }
                                            @endphp
                                         </h6>
                                        <div class="font-size-sm text-muted line-height-1">
                                            @php
                                                if(now()->diffInDays($chamado->created_at, false) != 0){
                                                    echo "Dia(s)";
                                                }else if(now()->diffInHours($chamado->created_at, false) != 0){
                                                    echo "Hora(s)";
                                                }else{
                                                    echo "Minuto(s)";
                                                }
                                            @endphp
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('chamados.show', $chamado->id) }}" class="text-default">
                                            <div class="font-weight-semibold">[#{{$chamado->id}}] {{$chamado->categoria}}</div>
                                            <div class="text-muted" style="max-width: 90ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; ">
                                                {{$chamado->descricao}}
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @permission('read-chamados')
                                                    <a href="{{ route('chamados.show', $chamado->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> Visualizar</a>
                                                    @endpermission
                                                    @permission('update-chamados')
                                                    <a href="{{ route('chamados.edit', $chamado->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Edit</a>
                                                    @endpermission
                                                    @permission('read-chamados')
                                                    <a href="{{ route('chamados.pdf', $chamado->id) }}" class="dropdown-item" target="_blank"><i class="icon-printer2"></i> Imprimir</a>
                                                    @endpermission
                                                    <div class="dropdown-divider"></div>
                                                    @permission('update-chamados')
                                                    <a href="{{ route('chamados.finishPage', $chamado->id) }}" class="dropdown-item"><i class="icon-checkmark3 text-success"></i> Finalizar Chamado</a>
                                                    @endpermission
                                                    @permission('delete-chamados')
                                                    <form method="POST" action="{{ route('chamados.destroy', $chamado->id) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item"><i class="icon-cross2 text-danger"></i> Deletar</button>
                                                    </form>
                                                    @endpermission
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan=4>
                                    <ul class="pagination pagination-pager pagination-rounded justify-content-center">
                                        @if ($chamados->previousPageUrl())
                                            <li class="page-item"><a href="{{ $chamados->previousPageUrl() }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if (!$chamados->previousPageUrl())
                                            <li class="page-item disabled"><a href="{{ $chamados->previousPageUrl() }}" class="page-link">← &nbsp; Anterior</a></li>
                                        @endif
                                        @if ($chamados->nextPageUrl())
                                            <li class="page-item"><a href="{{ $chamados->nextPageUrl() }}" class="page-link">Próximo &nbsp; →</a></li>
                                        @endif
                                        @if (!$chamados->nextPageUrl())
                                            <li class="page-item disabled"><a href="{{ $chamados->nextPageUrl() }}" class="page-link">Próximo &nbsp; →</a></li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            <!--Ticket Termina aqui-->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /support tickets -->
            <!-- Support tickets -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Status</th>
                                <th>Descrição</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td colspan="2">Chamados Finalizados (Últimos 5)</td>
                                <td class="text-right">
                                    <span class="badge bg-success badge-pill">{{count($chamadosFinalizadosTotal)}}</span>
                                </td>
                            </tr>
    
                            @foreach ($chamadosFinalizados as $cf)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="text-muted font-size-sm"><span class="badge badge-mark border-success mr-1"></span> Finalizado</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-default">
                                        <div>[#{{ $cf->id }}] {{ $cf->categoria }}</div>
                                        <div class="text-muted" style="max-width: 100ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; ">
                                            {{$cf->descricao}}
                                        </div>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @permission('read-chamados')
                                                <a href="{{ route('chamados.show', $cf->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> Visualizar</a>
                                                @endpermission
                                                @permission('read-chamados')
                                                <a href="{{ route('chamados.pdf', $cf->id) }}" class="dropdown-item" target="_blank"><i class="icon-printer2"></i> Imprimir</a>
                                                @endpermission
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /support tickets -->
        </div>
    </div>
@endsection