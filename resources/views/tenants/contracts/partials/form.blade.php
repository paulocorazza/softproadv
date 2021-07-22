@if( isset($data) )
    {!! Form::model($data, ['route' => ['contracts.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'contracts.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif


<div class="form-group label-float">
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'description']) !!}
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']); !!}
</div>

<div class="form-group">
    {!! Form::textarea('contract',null, ['class' => 'form-control', 'placeholder' => 'Contrato', 'id' => 'editor']) !!}
</div>



{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

