@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Atividades')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Atividades',
                                               'breadcrumbs' => [
                                               'Atividades', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_event')
            <p>
                <a href="{{route('events.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.events.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('events.index') }}';

        var columns = [
            {data: "id"},
            {data: "title"},
            {data: "start"},
            {data: "end"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




