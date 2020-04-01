@if( isset($data) )
    {!! Form::model($data, ['route' => ['group-actions.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'group-actions.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

