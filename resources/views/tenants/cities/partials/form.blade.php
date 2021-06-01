@if( isset($data) )
    {!! Form::model($data, ['route' => ['cities.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister' ]) !!}
@else
    {!! Form::open(['route' => 'cities.store', 'class' => 'form', 'id' => 'formRegister']) !!}
@endif

<div class="form-group">
    Selecione o Estado
    {!! Form::select('state_id', $states, null, ['class' => 'form-control', 'id' => 'state_id']) !!}
</div>

<div class="form-group label-float">
    {!! Form::text('iso', null, ['class' => 'form-control',  'placeholder' => ' ', 'iso' => 'iso']) !!}
    {!! Form::label('iso', 'IBGE', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('title', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'title']) !!}
    {!! Form::label('title', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



