@extends('adminlte::page')

@section('title_postfix', ' - Detalhes do Plano')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Planos',
                       'breadcrumbs' => [
                       'Planos' => route('plans.index'),
                       'Detalhes', ]
                      ])
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Plano</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <p><strong>ID: </strong>{{  $plan->id }}</p>
            <p><strong>Descrição: </strong>{{  $plan->description }}</p>
            <p><strong>Preço: </strong>{{  $plan->price }}</p>
            <p><strong>PayPal: </strong>{{  $plan->key_paypal }}</p>
            <p><strong>Status PayPal: </strong>{{  $plan->state_paypal }}</p>
        </div>
        <!-- /.card-body -->
    </div>

    {!! Form::model($plan, ['route' => ['plans.destroy', $plan->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
    {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete', 'rel' => $plan->id ]) !!}
    {!! Form::close() !!}
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop



