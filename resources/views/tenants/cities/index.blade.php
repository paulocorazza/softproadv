@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Cidades')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Cidades',
                                               'breadcrumbs' => [
                                               'Cidades', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        @can('create_city')
            <p>
                <a href="{{route('cities.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
        @endcan

    <!--TABELA -->
    @include('tenants.cities.partials.table')
    <!--TABELA -->
    </div>
@stop


@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('cities.index') }}';

        var columns = [
            {data: "id", name: 'id'},
            {data: "name", name: 'name'},
            {data: "state.initials", name: 'state.initials'},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop






