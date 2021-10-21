<!-- /.Google Calendar -->
<div class="card card-outline ">
    <div class="card-header">
        <h3 class="card-title">
            Google Agenda
            <small>Dados para integração</small>
        </h3>
        <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body pad">
        <div class="form-group label-float">
            {!! Form::text('google_calendar_api_key', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'google_calendar_api_key']) !!}
            {!! Form::label('google_calendar_api_key', 'API Key', ['class' => 'control-label']); !!}
        </div>

        <div class="form-group label-float">
            {!! Form::text('google_calendar_id', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'google_calendar_id']) !!}
            {!! Form::label('google_calendar_id', 'Id Agenda', ['class' => 'control-label']); !!}
        </div>

        <div class="form-group label-float">
            {!! Form::file('google_service_account_credentials', null, ['class' => 'form-control', 'placeholder' => 'JSON OAuth', 'id' => 'google_calendar_id']) !!}
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.Agenda Google-->
