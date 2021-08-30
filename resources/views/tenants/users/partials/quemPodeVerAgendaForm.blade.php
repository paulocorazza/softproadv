<!-- /.Agenda -->
<div class="card card-outline card-footer">
    <div class="card-header">
        <h3 class="card-title">
            Agenda
            <small>Quem pode ver sua agenda?</small>
        </h3>
        <!-- tools box -->
    @include('tenants.includes.toolsBox')
    <!-- /. tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body pad">
        {!! Form::label('users', 'Usuários', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('userViews', $userViews, @$usersSelected, ['class' => 'form-control',  'multiple' => 'multiple',  'id' => 'userViews', 'name' => 'userViews[]']) !!}
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.Agenda -->
