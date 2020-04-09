@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Fases')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Fases do Processo',
                                               'breadcrumbs' => [
                                               'Fases', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_phase')
            <p>
                <a href="{{route('phases.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.phases.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('phases.index') }}';

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




