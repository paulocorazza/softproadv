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
    {!! Form::text('id', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'id']) !!}
    {!! Form::label('id', 'IBGE', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>


<div class="form-group label-float">
    {!! Form::text('siafi', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'siafi']) !!}
    {!! Form::label('siafi', 'Siafi', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



