@extends('adminlte::page')

@section('title', 'Detalhes do Plano')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Planos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('tenants') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->id) }}" class="active">Detalhes</a>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="box box-success">
        <div class="box-body">
            <p><strong>ID: </strong>{{  $plan->id }}</p>
            <p><strong>Descrição: </strong>{{  $plan->description }}</p>
            <p><strong>Preço: </strong>{{  $plan->price }}</p>
            <p><strong>PayPal: </strong>{{  $plan->key_paypal }}</p>
            <p><strong>Status PayPal: </strong>{{  $plan->state_pagseguro }}</p>
        </div>
    </div>

    {!! Form::model($plan, ['route' => ['plans.destroy', $plan->id], 'class' => 'form', 'method' => 'delete' ]) !!}
    {!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop



