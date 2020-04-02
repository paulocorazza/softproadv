@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Estados')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Estados',
                                               'breadcrumbs' => [
                                               'Estados', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
       @can('create_state')
        <p>
            <a href="{{route('states.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>
        @endcan

        <!--TABELA -->
            @include('tenants.states.partials.table')
        <!--TABELA -->
    </div>
@stop


@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('states.index') }}';

        var columns =  [
            {data: "id", name : 'states.id'},
            {data: "country.name", name : 'country.name' },
            {data: "initials", name : 'states.initials'},
            {data: "name", name : 'states.name'},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop






