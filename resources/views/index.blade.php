@extends('layout/layoutCards')
@section('content')
<div class="w-100 order-2 order-md-1">

    <!-- Grid -->
    <div class="mb-3 pt-2">
        <h6 class="mb-0 font-weight-semibold">
            Sistemas
        </h6>
    </div>
    <div class="row">
        @role('almoxarifado')
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route("almoxarifado.index") }}" data-popup="lightbox">
                            <i class="icon-price-tags2 icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Almoxarifado</h5>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        @role('rh')
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('rh') }}" data-popup="lightbox">
                            <i class="icon-collaboration icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Recursos Humanos</h5>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        @role('chamados')
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('tecnologia') }}" data-popup="lightbox">
                            <i class="icon-windows icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                <!--<i class="icon-plus3 icon-2x">Acessar</i>-->
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Tecnologia</h5>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        @role('usuarios')
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('usuarios.index') }}" data-popup="lightbox">
                            <i class="icon-users icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">Usuários</h5>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        <!--<div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <div class="card-img-actions" align="center" style="padding: 20px">
                        <a href="{{ route('tecnologia') }}" data-popup="lightbox">
                            <i class="icon-users icon-4x"></i>
                            <span class="card-img-actions-overlay card-img">
                                Acessar
                            </span>
                        </a>
                        <br>
                        <br>
                        <h5 class="mb-0 font-weight-semibold">RH</h5>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    <!-- /grid -->

</div>
@endsection
