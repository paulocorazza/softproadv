@if( isset($data) )
    {!! Form::model($data, ['route' => ['permissions.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'permissions.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif

<div class="form-group">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:', 'id' => 'name']) !!}
</div>

<div class="form-group">
    {!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Descrição:', 'id' => 'label']) !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

