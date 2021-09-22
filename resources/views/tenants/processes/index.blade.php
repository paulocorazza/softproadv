@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Processos')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Processos',
                                               'breadcrumbs' => [
                                               'Processos', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
       @can('create_process')
        <p>
            <a href="{{route('processes.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>
        @endcan


       @include('tenants.processes.partials.search')

        <!--TABELA -->
            @include('tenants.processes.partials.table')
        <!--TABELA -->
    </div>
@stop


@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('processes.index') }}';

        var columns =  [
            {data: "id", name : 'processes.id'},
            {data: "number_process", name : 'processes.number_process'},
            {data: "person.name", name : 'person.name'},

            {data: 'listAdv', name: 'listAdv', orderable: false, searchable: false},
            {data: 'progress', name: 'list-adv', orderable: false, searchable: false},

            {data: "type_process", name : 'processes.type_process' },
            {data: "status", name : 'processes.status' },

            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/processes/table.js') }}></script>
@stop






