@extends('adminlte::page')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/datatables/css/jquery.dataTables.min.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/datatables/css/buttons.dataTables.min.css') }} />
@stop

@section('title_postfix', 'Empresas')

@section('content_header')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Empresas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('tenants') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="active">Empresas</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        <p>
            <a href="{{route('companies.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>

        <!--TABELA -->
            @include('tenants.companies.partials.table')
        <!--TABELA -->
    </div>
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/buttons.flash.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/buttons.html5.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/buttons.print.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/buttons.colVis.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/jszip.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/pdfmake.min.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/datatables/js/vfs_fonts.js') }}></script>
    <script type="text/javascript" src={{ asset('js/companies.js') }}></script>
@stop




