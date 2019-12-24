@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gestão de Planos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('tenants') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a>
                    </li>

                    @if (isset($plan))
                        <li class="breadcrumb-item"><a href="{{ route('plans.edit' , $plan->id) }}"
                                                       class="active">Editar</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('plans.create' ) }}"
                                                       class="active">Cadastrar</a></li>
                    @endif
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="box box-success">
        <div class="box-body">
            @include('tenants.plans.partials.form')
        </div>
    </div>
@stop


