@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Permissões')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Permissões' ,
                                               'breadcrumbs' => [
                                               'Permissões', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
       @can('create_permission')
        <p>
            <a href="{{route('permissions.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>
        @endcan

        <!--TABELA -->
    @include('tenants.permissions.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('permissions.index') }}';

        var columns = [
            {data: "id"},
            {data: "name"},
            {data: "label"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




