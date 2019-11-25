@if( isset($company) )
    {!! Form::model($company, ['route' => ['companies.update', $company->id], 'class' => 'form', 'method' => 'put' ]) !!}
@else
    {!! Form::open(['route' => 'companies.store', 'class' => 'form']) !!}
@endif

<div class="form-group">
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
</div>

<div class="form-group">
    {!! Form::label('subdomain', 'SubDomínio', ['class' => 'control-label']); !!}
    <div class="input-group mb-3">
        {!! Form::text('subdomain', null, ['class' => 'form-control', 'placeholder' => 'SubDomínio']) !!}

        <div class="input-group-append">
            <span class="input-group-text">.softpro.com.br</span>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('db_database', 'DataBase', ['class' => 'control-label']); !!}
    {!! Form::text('db_database', null, ['class' => 'form-control', 'placeholder' => 'DataBase']) !!}
</div>

<div class="form-group">
    {!! Form::label('db_host', 'Host', ['class' => 'control-label']); !!}
    {!! Form::text('db_host', null, ['class' => 'form-control', 'placeholder' => 'Host']) !!}
</div>


<div class="form-group">
    {!! Form::label('db_username', 'User Name', ['class' => 'control-label']); !!}
    {!! Form::text('db_username', null, ['class' => 'form-control', 'placeholder' => 'User Name']) !!}
</div>

<div class="form-group">
    <label for="db_password" class="control-label">Password</label>
    <input name="db_password" class="form-control" type="password"
           value="{{ $company->db_password ?? old('db_password') }}" id="db_password">
</div>

@if (!isset($company))
    <div class="form-group">
        {!! Form::checkbox('create_database', null, true) !!}
        {!! Form::label('create_database', 'Criar bando de dados?'); !!}
    </div>
@endif


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

