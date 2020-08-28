@if( isset($data) )
    {!! Form::model($data, ['route' => ['events.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'events.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif


<div class="row">
    <div class="col-12 ">
        {!! Form::label('users', 'Advogados', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('users', $users, null, ['class' => 'form-control',  'multiple' => 'multiple',  'id' => 'users', 'name' => 'users[]']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        {!! Form::label('process_id', 'Processo', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('process_id', $processes, null, ['placeholder' => 'Selecione o Processo', 'class' => 'form-control',  'id' => 'process_id']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('title', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'title']) !!}
            {!! Form::label('title', 'O que a pessoa irá fazer?', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::label('start', 'Data Início', ['class' => 'control-label']); !!}
            <br>
            <input type="datetime-local" class="form-control" name="start" id="start"
                   value="{{ old('start', \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', @$data->start)->format('Y-m-d\TH:i:s') ) }}">
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::label('end', 'Data Fim', ['class' => 'control-label']); !!}
            <br>
            <input type="datetime-local" class="form-control" name="end" id="end"
                   value="{{ old('end', \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', @$data->end)->format('Y-m-d\TH:i:s') ) }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('color', 'Cor', ['class' => 'control-label']); !!}
            {!! Form::color('color', null, ['class' => 'form-control date-time',  'placeholder' => ' ', 'id' => 'color']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Detalhes', 'id' => 'description', 'cols' => 20, 'rows' => 6]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::checkbox('schedule', null, null, ['id' => 'schedule']) !!}
        {!! Form::label('schedule', 'Mostrar na agenda'); !!}
    </div>
</div>

<div class="row">
    <div class="form-group">
        <input type="checkbox" name="finish" id="finish" {{ !empty(@$data->finish) ? 'checked' : '' }}>
        {!! Form::label('finish', 'Finalizado'); !!}
    </div>
</div>


<div class="form-group label-float">
    {!! Form::file('file',  ['class' => 'form-control', 'placeholder' => ' ']) !!}
    {!! Form::label('file', 'Arquivo', ['class' => 'control-label']); !!}
</div>

{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

