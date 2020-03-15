@if( isset($data) )
    {!! Form::model($data, ['route' => ['countries.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister' ]) !!}
@else
    {!! Form::open(['route' => 'countries.store', 'class' => 'form', 'id' => 'formRegister']) !!}
@endif

<div class="form-group label-float">
    {!! Form::text('id', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'id']) !!}
    {!! Form::label('id', 'Código', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



