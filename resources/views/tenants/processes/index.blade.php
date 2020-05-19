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
            {data: "person.name", name : 'person.name'},

            {data: 'listAdv', name: 'listAdv', orderable: false},
            {data: 'progress', name: 'list-adv', orderable: false},


            {data: "phase.name", name : 'phase.name' },
            {data: "stage.name", name : 'stage.name' },

            {data: 'action', name: 'action', orderable: false}
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop






