@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Conta Financeira')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Conta Financeira',
                                               'breadcrumbs' => [
                                               'Conta Financeira', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_financial_account')
            <p>
                <a href="{{route('financial-account.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.financial-account.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('financial-account.index') }}';

        var columns = [
            {data: "id"},
            {data: "description"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




