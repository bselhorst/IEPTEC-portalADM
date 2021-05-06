@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Empresas Terceirizadas</span>
@endsection

@section('page-title-buttons')
<!--<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>-->
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="#" class="breadcrumb-item active"><i class="icon-office mr-2"></i> Empresas Terceirizadaspedi</a>
@endsection

@section('content')
    <!-- Form validation -->
    <script src="{{ asset('backend/assets/js/jquery.mask.js') }}" type="text/javascript"></script>
    <div class="card">
        <div class="card-body">
            <form class="form-validate-jquery" method="POST" action="{{ (@$dataEdit) ? route('auxempresasterceirizados.update', $dataEdit->id) : route('auxempresasterceirizados.store') }}">
                @csrf
                @if(isset($dataEdit))
                    @method('PATCH')
                @endif
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{ (@$dataEdit) ? 'Editar' : 'Cadastrar'}}</legend>
                    <div class="form-group row" style="justify-content: center">
                        @if(isset($dataEdit))
                            <a href="/auxEmpresasTerceirizados" style="color: red">Você está editando registro, clique aqui para cancelar a edição</a>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <label class="col-form-label col-lg-1">Nome<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                            <input type="text" name="nome" class="form-control" placeholder="Ex: Empresa LTDA" value="{{ (@$dataEdit) ? $dataEdit->nome : ''}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <label class="col-form-label col-lg-1">Descrição<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                            <input type="text" name="descricao" class="form-control" placeholder="Ex: Descrição da empresa" value="{{ (@$dataEdit) ? $dataEdit->descricao : ''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <label class="col-form-label col-lg-1">CNPJ<span class="text-danger"></span></label>
                        <div class="col-lg-2">
                            <input type="text" name="cnpj" id="cnpj" data-mask="00.000.000/0000-00" class="form-control" placeholder="00.000.000/0001-00" value="{{ (@$dataEdit) ? $dataEdit->cnpj : ''}}">
                        </div>
                    </div>
                </fieldset>
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary ml-3">{{(@$dataEdit) ? 'Editar' : 'Cadastrar' }}<i class="{{(@$dataEdit) ? 'icon-pencil7' : 'icon-add' }} ml-2"></i></button>
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
                    @role('patrimonio')
                    <li>
                        <div data-fab-label="Cadastrar">
                            <a href="{{ route('patrimonio.create') }}" class="btn btn-light rounded-round btn-icon btn-float">
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
                                <th>Tabela de Fornecedores</th>
                                <th class="text-center" style="width: 20px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active table-border-double">
                                <td>Nome</td>
                                <td>Descrição</td>
                                <td>CNPJ</td>
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
                                        <div class="font-weight-semibold">{{ $item->descricao }}</div>
                                    </td>
                                    <td>
                                        <div class="font-weight-semibold">{{ $item->cnpj }}</div>
                                    </td>
                                    </td>
                                    <td class="text-right">
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a href="{{ route('auxempresasterceirizados.edit', $item->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Editar</a>

                                                    {{-- <form method="POST" action="{{ route('auxempresasterceirizados.destroy', $data->id) }}" onsubmit="return confirm('Deseja deletar esse dado?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item"><i class="icon-cross2 text-danger"></i> Deletar</button>
                                                    </form> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan=5>
                                    @php
                                        //$url = '';
                                        //request()->descricao? $url.='&descricao='.request()->descricao : '';
                                        //request()->data? $url.='&patrimonio='.request()->descricao : '';
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
