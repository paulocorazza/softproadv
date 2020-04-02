@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Pais')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Pais',
                                               'breadcrumbs' => [
                                               'Pais', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        @can('create_country')
            <p>
                <a href="{{route('countries.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
        @endcan

    <!--TABELA -->
    @include('tenants.countries.partials.table')
    <!--TABELA -->
    </div>
@stop


@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('countries.index') }}';;

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






