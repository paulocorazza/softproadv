@if( isset($data) )
    {!! Form::model($data, ['route' => ['financial-category.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'financial-category.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif

<div class="form-group">
    {!! Form::label('type', 'Tipo', ['class' => 'control-label']); !!}
    {!! Form::select('type', ['Receita' => 'Receita', 'Despesa' => 'Despesa'] ,  'Receita', ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'type']) !!}
</div>

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

