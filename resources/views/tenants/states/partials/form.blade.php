@if( isset($data) )
    {!! Form::model($data, ['route' => ['states.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister' ]) !!}
@else
    {!! Form::open(['route' => 'states.store', 'class' => 'form', 'id' => 'formRegister']) !!}
@endif

<div class="form-group">
    Selecione o Pais
    {!! Form::select('country_id', $countries, null, ['class' => 'form-control', 'id' => 'country_id']) !!}
</div>

<div class="form-group label-float">
    {!! Form::text('letter', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'letter']) !!}
    {!! Form::label('letter', 'Inicial', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('title', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'title']) !!}
    {!! Form::label('title', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



