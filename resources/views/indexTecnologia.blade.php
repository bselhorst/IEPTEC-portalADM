@extends('layout/layoutCards')
@section('content')
<div class="w-100 order-2 order-md-1">

    <!-- Grid -->
    <div class="mb-3 pt-2">
        <h6 class="mb-0 font-weight-semibold">
            Módulos
        </h6>
    </div>
    @role('chamados')
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('chamados.index') }}" data-popup="lightbox">
                            <i class="icon-ticket icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Chamados</h5>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    @endrole
    @role('auxiliar-tecnologia')
    <div class="mb-3 pt-2">
        <h6 class="mb-0 font-weight-semibold">
            Tabelas Auxiliares
        </h6>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('categorias.index') }}" data-popup="lightbox">
                            <i class="icon-books icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Categorias</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('marcas.index') }}" data-popup="lightbox">
                            <i class="icon-books icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Marcas</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('setores.index') }}" data-popup="lightbox">
                            <i class="icon-office icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Setores</h5>
                    </div>
                </div>
            </div>
        </div>        
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('tecnicos.index') }}" data-popup="lightbox">
                            <i class="icon-users icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Técnicos</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('tiposequipamentos.index') }}" data-popup="lightbox">
                            <i class="icon-books icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Tipos de Equipamentos</h5>
                    </div>
                </div>
            </div>
        </div>
        @endrole        
    </div>
    <!-- /grid -->

</div>
@endsection