@extends('adminlte::page')

@section('title_postfix', ' - Detalhes do Processos')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
    <link rel="stylesheet" href={{ asset('assets/css/process/process.css') }} />
@stop

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' =>  isset($data->id) ? 'Gestão de Processos - ' . $data->number_process : 'Gestão de Processos' ,
                               'breadcrumbs' => [
                               'Processos' => route('processes.index'),
                                isset($data->id) ? 'Detalhes' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalhes do Processo - <a
                        href="{{ route('processes.edit', $data->id)  }}">Editar</a></h3>

                <div class="card-tools">
                    @if($data->monitoring == true)
                        @can('monitor_stop')
                            <form action="{{route('processes.monitor.stop', $data->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <button type="submit" class="btn btn-danger text-white">
                                    <i class="fas fa-stop-circle"></i>
                                    Monitorando
                                </button>
                            </form>
                        @endcan
                    @else
                        @can('monitor_start')
                             <form action="{{route('processes.monitor.start', $data->id)}}" method="post">
                                 @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <button type="submit" class="btn btn-danger text-white">
                                    <i class="fas fa-play-circle"></i>
                                    Monitorar
                                </button>
                            </form>
                        @endcan
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span
                                            class="info-box-text text-center text-muted">Expectativa / Valor da Causa</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->expectancy }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Valor dos honorários</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->price }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Honorários (%)</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->percent_fees }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4>Andamento do Processo</h4>
                                <!-- The time line -->
                                <div class="timeline">
                                @foreach($progresses as $index => $value)
                                    <!-- timeline time label -->
                                        <div class="time-label">
                                            <span
                                                class="bg-red">{{ \App\Helpers\Helper::formatDateTime($index, 'd/m/Y') }}</span>
                                        </div>
                                        <!-- /.timeline-label -->
                                    @foreach($value as $progress)
                                        <!-- timeline item -->
                                            <div>
                                                <i class="fas {{ $progress->concluded ? 'fa-envelope' : 'fa-clock' }}   bg-blue"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i>  Prazo: {{ \App\Helpers\Helper::formatDateTime($progress->date_term, 'd/m/Y') }}</span>
                                                    <span class="time">{{ $progress->category }}</span>
                                                    <h3 class="timeline-header">
                                                        <strong>{{ $progress->description }}</strong> {{ $progress->concluded ? 'Concluído' : 'Pendente' }}
                                                    </h3>

                                                    <div class="timeline-body">
                                                        {{ $progress->publication }}
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                    <!-- END timeline item -->
                                        <!-- timeline item -->
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        @if(count($data->events) > 0)
                            <div class="row">
                                <div class="col-12">
                                    <h4>Atividades Recentes</h4>
                                    @foreach($data->events as $event)
                                        <div class="post">
                                            <div class="user-block">
                                                @foreach($event->users as $user)
                                                    @if( !empty($user->image) )
                                                        <div class="img-post">
                                                            <img src="{{ asset('storage/tenants/' . $user->image) }}"
                                                                 alt="{{$user['name']}}"
                                                                 class="user-dashboard img-circle">
                                                        </div>
                                                    @else
                                                        <div class="img-post">
                                                            <img src="{{ url('assets/images/no-image.png') }}"
                                                                 alt="SoftPro"
                                                                 class="user-dashboard img-circle">
                                                        </div>
                                                    @endif
                                                @endforeach


                                                <span class="username">
                                                    <a href="{{ route('events.show', $event->id) }}">{{ $event->title }}</a>
                                                </span>

                                                <span
                                                    class="description">Início: {{ $event->start }} - Fim: {{ $event->end }}</span>
                                                <span
                                                    class="description">{{ !empty($event->finish) ? 'Finalizado' : 'Pendente' }}</span>
                                            </div>
                                            <!-- /.user-block -->

                                            <p>
                                                {{ $event->description }}
                                            </p>


                                            @if(!empty($event->file))
                                                <p>
                                                    <a href="{{ route('events.fileDownload', $event->id) }}"
                                                       class="link-black text-sm"><i class="fas fa-link mr-1"></i>Anexo</a>
                                                </p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i>
                            Processo <a href="{{ route('processes.edit', $data->id)  }}">{{ $data->number_process }}</a>
                        </h3>
                        <p class="text-muted">{{ $data->description}}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Status
                                <b class="d-block">{{ $data->status }}</b>
                                @if($data->isCanceled())
                                    <b class="d-block">Em: {{ $data->canceled_at_br }}</b>
                                @endif
                            </p>

                            <p class="text-sm">Cliente
                                <b class="d-block"><a
                                        href="{{ route('people.show', $data->person_id) }}">{{ $data->person->name }}</a></b>
                            </p>
                            <p class="text-sm">Parte Contrária
                                <b class="d-block"><a
                                        href="{{ route('people.show', $data->counterpart_id) }}">{{ $data->counterPart->name }}</a>
                                </b>
                            </p>

                            @if(!empty($data->judge_id))
                                <p class="text-sm">Juiz
                                    <b class="d-block"><a
                                            href="{{ route('people.show', $data->judge_id) }}">{{ $data->judge->name }}</a></b>
                                </p>
                            @endif
                        </div>

                        <h5 class="mt-5 text-muted">Arquivos do Processo</h5>
                        <ul class="list-unstyled">
                            @foreach($data->files as $file)
                                <li>
                                    <a href="{{ route('fileDownload', $file->id) }}"
                                       class="btn-link text-secondary"><i
                                            class="far fa-fw fa-file-word"></i> {{ $file->description }}</a>
                                </li>
                            @endforeach
                        </ul>


                        <h5 class="mt-5 text-muted">Advogados</h5>
                        <ul class="list-unstyled">
                            @foreach($data->users as $user)
                                <li>
                                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                        <div class="image">
                                            @if( !empty($user->image) )
                                                <img src="{{ asset('storage/tenants/' . $user->image) }}"
                                                     alt="{{$user['name']}}"
                                                     class="user-dashboard img-circle">
                                            @else
                                                <img src="{{ url('assets/images/no-image.png') }}" alt="SoftPro"
                                                     class="user-dashboard img-circle">
                                            @endif
                                        </div>
                                        <div class="info">

                                            <a href="{{ route('users.show', $user->id) }}"
                                               class="d-block">{{ $user->name }}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="row">
                            <div class="col-12">
                                <h5 class="mt-5 text-muted">Etapas Concluídas</h5>
                                @foreach($stages as $stage)
                                    <div class="post">
                                        <div class="user-block">
                                            <img src="{{ asset('assets/images/check.png') }}"
                                                 class="img-circle img-bordered-sm" alt="active">
                                            <span class="username">
                          <a href="#">{{ $stage->stage->name }}</a>
                        </span>
                                            <span
                                                class="description"> {{ \App\Helpers\Helper::formatDateTime($stage->created_at, 'd/m/Y') }}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>Concluído por: {{ $stage->user->name }} </p>
                                        <a class="j_link_delete" href="{{ route('stageDelete', $stage->id) }}">Remover
                                            Etapa</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>

    @can('delete_state')
        {!! Form::model($data, ['route' => ['processes.destroy', $data->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
        {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete', 'rel' => $data->id ]) !!}
        {!! Form::close() !!}
    @endcan
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop



