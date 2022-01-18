@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Chamados</span>
@endsection

@section('page-title-buttons')
<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('chamados.index') }}" class="breadcrumb-item active"><i class="icon-calendar mr-2"></i> Calendario</a>
@endsection

@section('content')

<script>
    var FullCalendarBasic = function () {
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

    // Basic calendar
    var _componentFullCalendarBasic = function () {
        if (typeof FullCalendar == 'undefined') {
            console.warn('Warning - Fullcalendar files are not loaded.');
            return;
        }

        // Default events
        var events = [
            {
                title: 'Feriado',
                start: '2022-01-21',
                color: '#ff9f89',
                display: 'background',
            },
            {
                title: 'Resolver Problema no Maria Moreira',
                start: '2022-01-19',
                color: '#26A69A',
            },
            {
                title: 'Viajem para Cruzeiro do Sul',
                start: '2022-01-19',
                end: '2022-01-22',
                color: '#26A69A'
            },
            // {
            //     title: 'Eu poderia colocar um evento grande somente para testar esse campo',
            //     start: '2022-01-18T10:00',
            //     end: '2022-01-18T16:00',
            //     color: '#26A69A'
            // },
            {
                title: 'EAD - Trocar Máquina Lygia (Fazer Backup)',
                start: '2022-01-18'
            },
            {
                title: 'Gabinete - Troca do Roteador',
                start: '2022-01-18'
            },
            {
                title: 'Gabinete - Compartilhar impressora na sala do Presidente',
                start: '2022-01-18'
            },
            {
                title: '5º etinerário - Verificar rede. Impressora demora muito a imprimir',
                start: '2022-01-18'
            },
            {
                title: 'Recepção - Computador com lentidão. Fazer limpeza de Sistema',
                start: '2022-01-18'
            },
            {
                title: 'Financeiro - Mudar posição dos cabos de máquina Paulo',
                start: '2022-01-18'
            },
            {
                title: 'Financeiro - Cabo de rede está atrapalhando passagem',
                start: '2022-01-18'
            },
        ];

        // Define element
        var calendarBasicViewElement = document.querySelector('.fullcalendar-basic');
        var initialLocaleCode = 'pt-br';
        // Initialize
        if (calendarBasicViewElement) {
            var calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                plugins: ['dayGrid', 'interaction'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                locale: initialLocaleCode,
                defaultDate: date,
                defaultView: 'dayGridWeek',
                editable: true,
                events: events,
                eventLimit: true,
            }).render();
        }
    };

    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentFullCalendarBasic();
        }
    }
    }();


    // Initialize module
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function () {
    FullCalendarBasic.init();
    });

</script>

<div class="card">
    <div class="card-header header-elements-inline">
        {{-- <h5 class="card-title">Basic view</h5> --}}
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="fullcalendar-basic"></div>
    </div>
</div>
@endsection
