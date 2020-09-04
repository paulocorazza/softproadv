@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Categoria Financeira')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Categoria Financeira',
                                               'breadcrumbs' => [
                                               'Categoria Financeira', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_financial_category')
            <p>
                <a href="{{route('financial-category.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.financial-category.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('financial-category.index') }}';

        var columns = [
            {data: "id"},
            {data: "type"},
            {data: "name"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




