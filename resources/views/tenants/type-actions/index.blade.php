@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Tipos de Ações')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Tipos de Ações',
                                               'breadcrumbs' => [
                                               'Estados', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
       @can('create_type_action')
        <p>
            <a href="{{route('type-actions.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>
        @endcan

        <!--TABELA -->
            @include('tenants.type-actions.partials.table')
        <!--TABELA -->
    </div>
@stop


@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('type-actions.index') }}';

        var columns =  [
            {data: "id", name : 'type_actions.id'},
            {data: "name", name : 'type_actions.name'},
            {data: "group_action.name", name : 'group_action.name' },

            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop






