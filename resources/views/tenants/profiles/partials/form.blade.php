@if( isset($data) )
    {!! Form::model($data, ['route' => ['profiles.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'profiles.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'label']) !!}
    {!! Form::label('label', 'Descrição', ['class' => 'control-label']); !!}
</div>

{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

