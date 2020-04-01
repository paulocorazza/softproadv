@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Grupo de Ações')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Grupo de Ações',
                                               'breadcrumbs' => [
                                               'Grupo de Ações', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_group_action')
            <p>
                <a href="{{route('group-actions.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.group-actions.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '/group-actions';

        var columns = [
            {data: "id"},
            {data: "name"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




