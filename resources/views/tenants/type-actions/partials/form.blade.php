@if( isset($data) )
    {!! Form::model($data, ['route' => ['type-actions.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister' ]) !!}
@else
    {!! Form::open(['route' => 'type-actions.store', 'class' => 'form', 'id' => 'formRegister']) !!}
@endif

<div class="form-group">
    Selecione o Grupo de Ação
    {!! Form::select('group_action_id', $groups, null, ['class' => 'form-control', 'id' => 'group_action_id']) !!}
</div>

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>



