@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Planos')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Tipos de Endereço',
                                               'breadcrumbs' => [
                                               'Tipos de Endereço', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        <p>
            <a href="{{route('type-address.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>

        <!--TABELA -->
            @include('tenants.typeAddress.partials.table')
        <!--TABELA -->
    </div>
@stop


@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('type-address.index') }}';

        var columns =  [
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






