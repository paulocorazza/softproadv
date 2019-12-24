@if( isset($plan) )
    {!! Form::model($plan, ['route' => ['plans.update', $plan->id], 'class' => 'form', 'method' => 'put' ]) !!}
@else
    {!! Form::open(['route' => 'plans.store', 'class' => 'form']) !!}
@endif

<div class="form-group">
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']); !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição']) !!}
</div>


<div class="form-group">
    {!! Form::label('price', 'Preço', ['class' => 'control-label']); !!}
    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Preço']) !!}
</div>


<div class="row">
    <div class="col-md-4 form-group">
        {!! Form::label('frequency', 'Frequência', ['class' => 'control-label']); !!}
        {!! Form::select('frequency', [
            'day' => 'Por Dia',
            'week' => 'Por Semana',
            'month' => 'Por Mês',
            'year' => 'Por Ano'
        ], null, ['class' => 'form-control']) !!}
    </div>


    <div class="col-md-4 form-group">
        {!! Form::label('frequency_interval', 'Intervalo', ['class' => 'control-label']); !!}
        {!! Form::text('frequency_interval', null, ['class' => 'form-control', 'placeholder' => 'Intervalo']) !!}
    </div>

    <div class="col-md-4 form-group">
        {!! Form::label('cycles', 'Ciclos', ['class' => 'control-label']); !!}
        {!! Form::text('cycles', null, ['class' => 'form-control', 'placeholder' => 'Ciclos']) !!}
    </div>
</div>


<div class="row col-md-12">
    {!! Form::label('key_paypal', 'PayPal Key', ['class' => 'control-label']); !!}

    <div class="input-group">
        {!! Form::text('key_paypal', null, ['class' => 'form-control', 'placeholder' => 'PayPal Key',
        'aria-label' =>"Recipient's username", 'aria-describedby' => "basic-addon2"]) !!}

        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btnKeyPayPal">Gerar Key-PayPal</button>
        </div>
    </div>
</div>

<br>


<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Adicionar detalhes</h3>
    </div>
    <div class="card-body">
        <div class="row form-group">
            <div class="d-flex d-inline-block col-md-6">
                <input id="detail" type="text" class="form-control" placeholder="Detalhe">
                <button type="button" id="add_details" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped" id="details_table">
                <thead>
                <tr>
                    <th>Detalhe</th>
                    <th>Ação</th>
                </tr>
                </thead>

                <tbody>
                @if(isset($plan))
                    @forelse($plan->plan_details as $details)
                        <tr>
                            <td>
                                <input class="form-control" type="text" name="details[]"
                                       value="{{ $details->description }}">
                            </td>
                            <td><a class="btn btn-danger" href="javascript:;" onclick="removeDetail(this)">Excluir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Nenhum detalhe adicionado</td>
                        </tr>
                    @endforelse
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

@section('js')
    <script type="text/javascript" src={{ asset('assets/js/plans/script.js') }}></script>
@stop

