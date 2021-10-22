@extends('adminlte::page')

@section('title_postfix', ' - Detalhes do Atendimento')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Atendimentos',
                               'breadcrumbs' => [
                               'Atendimentos' => route('meets.index'),
                               'Detalhes', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Atendimento</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <p><strong>ID: </strong>{{  $data->id }}</p>
            <p><strong>Advogados</strong>{{  $data->name }}</p>
            <ul class="list-group list-group-horizontal">
                @foreach($data->users as $user)
                    <li class="list-group-item">{{ $user->name }}</li>
                @endforeach
            </ul>
            <br>

            @if(isset($data->process_id))
            <p><strong>Processo: </strong>
                <a href="{{ route('processes.show', $data->process_id) }}">{{ $data->process->process_person }}</a>
            </p>
            @endif

            <p><strong>Cliente: </strong>
                {{ $data->person }}
            </p>

            <p><strong>Título do atendimento: </strong>
            <p>{{  $data->title}}</p>
            <p><strong>Data do Atendimento: </strong>{{ $data->created_at_br }}
            </p>
            <p><strong>Detalhes: </strong>
            <p>{!! $data->description !!}</p>

            <p><strong>Concluído? {{ (!empty($data->concluded_at)) ? ('Sim') : ('Não') }} </strong>

        </div>
        <!-- /.card-body -->
    </div>

    @can('delete_phase')
        {!! Form::model($data, ['route' => ['meets.destroy', $data->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
        {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete']) !!}
        {!! Form::close() !!}
    @endcan
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop

