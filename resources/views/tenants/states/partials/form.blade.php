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
    {!! Form::text('initials', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'initials']) !!}
    {!! Form::label('initials', 'Inicial', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



