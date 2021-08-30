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
            {!! Form::text('googleCalendarApiKey', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'googleCalendarApiKey']) !!}
            {!! Form::label('googleCalendarApiKey', 'API Key', ['class' => 'control-label']); !!}
        </div>

        <div class="form-group label-float">
            {!! Form::text('googleCalendarId', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'googleCalendarId']) !!}
            {!! Form::label('googleCalendarId', 'Id Agenda', ['class' => 'control-label']); !!}
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.Agenda Google-->
