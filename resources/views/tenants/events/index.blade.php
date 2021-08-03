@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Atividades')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Atividades',
                                               'breadcrumbs' => [
                                               'Atividades', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_event')
            <p>
                <a href="{{route('events.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    @include('tenants.events.partials.search')

    <!--TABELA -->
    @include('tenants.events.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('events.index') }}';

        var columns = [
            {data: "id"},
            {data: "process.number_process", name : 'process.number_process', orderable: false},
            {data: 'listAdv', name: 'listAdv', orderable: false, searchable: false},
            {data: "title"},
            {data: "start"},
            {data: "end"},
            {data: "finish"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/events/table.js') }}></script>
@stop




