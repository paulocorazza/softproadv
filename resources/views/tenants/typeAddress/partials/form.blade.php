@if( isset($data) )
    {!! Form::model($data, ['route' => ['type-address.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister' ]) !!}
@else
    {!! Form::open(['route' => 'type-address.store', 'class' => 'form', 'id' => 'formRegister']) !!}
@endif

<div class="form-group label-float">
    {!! Form::text('description', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'description']) !!}
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



