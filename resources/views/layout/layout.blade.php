@php
	//$name = explode(' ', Auth::user()->name);
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>IEPTEC</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('backend/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('backend/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('backend/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('backend/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('backend/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('backend/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('backend/global_assets/js/plugins/ui/fab.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

	<script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/dashboard.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/demo_pages/form_validation.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/demo_pages/form_select2.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/demo_pages/form_multiselect.js') }}"></script>
	<script src="{{ asset('backend/global_assets/js/demo_pages/components_modals.js') }}"></script>
	<!-- /theme JS files -->

</head>
<body>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand" style="padding-top: 0; padding-bottom: 0;">
			<a href="/" class="d-inline-block" style="padding-top: 8px; padding-left: 80px">
				<img src="{{ asset('backend/global_assets/images/logo_light.png') }}"  style="height: 32px">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>

			<span class="ml-md-3 mr-md-auto">Sistema de Gestão Integrado - SGI</span>

			<ul class="navbar-nav">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
						@php
							$user = explode(' ', Auth::user()->name);
						@endphp
						{{ $user[0]." ".last($user) }}
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Configurações</a>
						<div class="dropdown-divider"></div>
						<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="color: #E57373"><i class="icon-switch2"></i> Logout</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="{{ asset('backend/global_assets/images/placeholders/placeholder.jpg') }}" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">{{ $user[0]." ".last($user) }}</div>
								<div class="font-size-xs opacity-50">
									Funcionário
								</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->

				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="/" class="nav-link">
								<i class="icon-home4"></i>
								<span>
									Principal
								</span>
							</a>
						</li>
						<!-- /main -->

                        {{-- Almoxarifado --}}
                        @role('almoxarifado')
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Almoxarifado</div> <i class="icon-menu" title="Forms"></i></li>
                            @role('almoxarifado')
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-price-tags"></i> <span>Almoxarifado</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
                                    <li class="nav-item"><a href="{{ route('auxfornecedores.index') }}" class="nav-link">Aux. Fornecedores</a></li>
                                    <li class="nav-item"><a href="{{ route('auxunidades.index') }}" class="nav-link">Aux. Unidades</a></li>
                                    <li class="nav-item"><a href="{{ route('almoxarifado.index') }}" class="nav-link">Almoxarifado</a></li>
                                    <li class="nav-item"><a href="{{ route('almoxarifado.retirar') }}" class="nav-link">Retirar Itens</a></li>
                                    <li class="nav-item"><a href="{{ route('almoxarifado.historico_entradas') }}" class="nav-link">Histórico de Entradas</a></li>
                                    <li class="nav-item"><a href="{{ route('almoxarifado.historico_retiradas') }}" class="nav-link">Histórico de Retiradas</a></li>
                                </ul>
                            </li>
                            @endrole
                        @endrole
                        {{-- Almoxarifado --}}

                        <!-- RH -->
						@role(['patrimonio'])
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Patrimonio</div> <i class="icon-menu" title="Forms"></i></li>
                        @endrole
                        @role('patrimonio')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-cog"></i> <span>Auxiliares</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('auxsituacaobem.index') }}" class="nav-link">Situação do Bem</a></li>
							</ul>
						</li>
                        @endrole
                        @role('patrimonio')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-bag"></i> <span>Bem Patrimonial</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('patrimoniobens.create') }}" class="nav-link">Cadastrar</a></li>
								<li class="nav-item"><a href="{{ route('patrimoniobens.index') }}" class="nav-link">Listar</a></li>
							</ul>
						</li>
						@endrole
						@role('patrimonio')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-barcode2"></i> <span>Patrimonio</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('patrimonio.create') }}" class="nav-link">Cadastrar</a></li>
								<li class="nav-item"><a href="{{ route('patrimonio.index') }}" class="nav-link">Listar</a></li>
							</ul>
						</li>
						@endrole
						<!-- /rh -->

						<!-- RH -->
						@role(['rh'])
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Recursos Humanos</div> <i class="icon-menu" title="Forms"></i></li>
						@endrole
						@role('rh')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-cog"></i> <span>Auxiliares</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('funcoes.index') }}" class="nav-link">Funções</a></li>
								<li class="nav-item"><a href="{{ route('setores.index') }}" class="nav-link">Setores</a></li>
							</ul>
						</li>
						@endrole
						@role('rh')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-users"></i> <span>Pessoas</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('pessoas.create') }}" class="nav-link">Cadastrar</a></li>
								<li class="nav-item"><a href="{{ route('pessoas.index') }}" class="nav-link">Listar</a></li>
								<li class="nav-item"><a href="{{ route('pessoas.indexContratoGeral') }}" class="nav-link">Vencimento de Contratos</a></li>
							</ul>
						</li>
						@endrole
						<!-- /rh -->

						<!-- Tecnologia -->
						@role(['chamados', 'auxiliar-tecnologia', 'usuarios-sa'])
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Tecnologia</div> <i class="icon-menu" title="Forms"></i></li>
						@endrole
						@role('auxiliar-tecnologia')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-cog"></i> <span>Auxiliares</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('categorias.index') }}" class="nav-link">Categorias</a></li>
								<li class="nav-item"><a href="{{ route('marcas.index') }}" class="nav-link">Marcas</a></li>
								<li class="nav-item"><a href="{{ route('tecnicos.index') }}" class="nav-link">Técnicos</a></li>
								<li class="nav-item"><a href="{{ route('tiposcontratos.index') }}" class="nav-link">Tipos de Contratos</a></li>
								<li class="nav-item"><a href="{{ route('tiposequipamentos.index') }}" class="nav-link">Tipos de Equipamentos</a></li>
							</ul>
						</li>
						@endrole
						@role('chamados')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-ticket"></i> <span>Chamados</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('chamados.create') }}" class="nav-link">Cadastrar</a></li>
								<li class="nav-item"><a href="{{ route('chamados.index') }}" class="nav-link">Listar</a></li>
								<li class="nav-item"><a href="{{ route('chamados.search') }}" class="nav-link">Pesquisar</a></li>
							</ul>
						</li>
						@endrole
						@role('usuarios-sa')
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-users"></i> <span>Usuários S.A.</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('usuariossa.create') }}" class="nav-link">Cadastrar</a></li>
								<li class="nav-item"><a href="{{ route('usuariossa.index') }}" class="nav-link">Listar</a></li>
							</ul>
						</li>
						@endrole
						<!-- /tecnologia -->

						<!-- Usuários -->
						@role('usuarios')
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Usuários</div> <i class="icon-menu" title="Forms"></i></li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-users"></i> <span>Usuários</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="JSON forms" style="display: none;">
								<li class="nav-item"><a href="{{ route('usuarios.create') }}" class="nav-link">Cadastrar</a></li>
								<li class="nav-item"><a href="{{ route('usuarios.index') }}" class="nav-link">Listar</a></li>
							</ul>
						</li>
						@endrole
						<!-- /usuarios -->

						<hR>
						<li class="nav-item">
							<a href="#" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
								<i class="icon-switch2" style="color: #E57373;"></i>
								<span style="color: #E57373">
									Logout
								</span>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</a>
						</li>
					</ul>
				</div>
				<!-- /main navigation -->
			</div>
			<!-- /sidebar content -->
		</div>
		<!-- /main sidebar -->
    <!-- Main content -->
	<div class="content-wrapper">

<!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>@yield('page-title')</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    @yield('page-title-buttons')
                </div>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    @yield('breadcrumb')
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

        @yield('content')

        </div>
        <!-- /content area -->

        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-footer">
                <span class="navbar-text">
                    &copy; 2020. IEPTEC - Instituto Estadual de Educação Profissional e Tecnológico
                </span>
            </div>
        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
