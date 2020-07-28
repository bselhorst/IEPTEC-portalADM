@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Chamados</span> - Visualizar
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('chamados.index') }}" class="breadcrumb-item"><i class="icon-ticket mr-2"></i> Chamados</a>
<span class="breadcrumb-item active">Visualizar</span>
@endsection

@section('content')

    @php
        //$user=$chamado->find($chamado->id)->relUsers;
    @endphp

    <div class="card">
        <div class="card-header bg-transparent header-elements-inline">
            <h6 class="card-title">Detalhes</h6>
            <div class="header-elements">
                <a href="{{ route('chamados.pdf', $chamado->id) }}" type="button" class="btn btn-light btn-sm ml-3"><i class="icon-printer mr-2"></i> Imprimir</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-4">	
                        <ul class="list list-unstyled mb-0">
                            <li><h5 class="my-2"><b>Categoria</b></li>
                            <li style="text-align: justify">{{ $chamadoCompleto[0]->categoria }}</li>
                            <li><h5 class="my-2"><b>Setor</b></li>
                            <li style="text-align: justify">{{ $chamadoCompleto[0]->nome }}</li>
                            <li><h5 class="my-2"><b>Solicitante</b></li>
                            <li style="text-align: justify">{{ $chamado->solicitante }}</li>
                            <li><h5 class="my-2"><b>Descrição</b></li>
                            <li style="text-align: justify">{{ $chamado->descricao }}</li>
                            <li><h5 class="my-2"><b>Solução</b></h3></li>
                            <li style="text-align: justify">{{ $chamado->solucao }}</li>
                        </ul>
                    </div>
                    <div class="pt-2 mb-3">
                        <h6 class="mb-1">Técnico</h6>
                        <ul class="list-unstyled text-muted">
                            <li>{{ $chamadoCompleto[0]->name }}</li>
                            <li>{{ $user->email }}</li>
                            <li>Departamento de Tecnologia da Informação</li>
                            <li>IEPTEC - Instituto Educacional Profissionalizante e Tecnológico</li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-4">
                        <div class="text-sm-right">
                            <h4 class="text-primary mb-2 mt-md-2">Chamado #{{ $chamado->id }}</h4>
                            <ul class="list list-unstyled mb-0">
                                <li>Abertura: <span class="font-weight-semibold">{{ $chamado->created_at->format('d M Y H:i:s') }}</span></li>
                                @if ($chamado->finished_at != null)
                                    @php
                                        $finished_time = strtotime($chamado->finished_at);
                                    @endphp
                                    <li>Fechamento: <span class="font-weight-semibold">{{ date("d M Y H:i:s", $finished_time) }}</span></li>
                                @endif                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection