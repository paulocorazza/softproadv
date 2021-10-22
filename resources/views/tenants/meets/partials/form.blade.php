@if( isset($data) )
    {!! Form::model($data, ['route' => ['meets.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'meets.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif


<div class="row">
    <div class="col-12 ">
        {!! Form::label('users', 'Advogados', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('users', $users, null, ['class' => 'form-control',  'multiple' => 'multiple',  'id' => 'users', 'name' => 'users[]']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        {!! Form::label('process_id', 'Processo', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('process_id', $processes, null, ['placeholder' => 'Selecione o Processo', 'class' => 'form-control',  'id' => 'process_id']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('person', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'person']) !!}
            {!! Form::label('person', 'Nome do Cliente', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('title', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'title']) !!}
            {!! Form::label('title', 'Título do atendimento', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Detalhes', 'id' => 'description', 'cols' => 20, 'rows' => 6]) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="form-group">
        <input type="checkbox" name="concluded_at" id="concluded_at" {{ !empty(@$data->concluded_at) ? 'checked' : '' }}>
        {!! Form::label('concluded_at', 'Concluído'); !!}
    </div>
</div>

{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<div class="preload">
    @include('tenants.includes.load')
</div>

<br/>

