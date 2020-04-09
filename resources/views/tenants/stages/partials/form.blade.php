@if( isset($data) )
    {!! Form::model($data, ['route' => ['stages.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister' ]) !!}
@else
    {!! Form::open(['route' => 'stages.store', 'class' => 'form', 'id' => 'formRegister']) !!}
@endif

<div class="form-group">
    Selecione a fase do processo
    {!! Form::select('phase_id', $phases, null, ['class' => 'form-control', 'id' => 'phase_id']) !!}
</div>

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



