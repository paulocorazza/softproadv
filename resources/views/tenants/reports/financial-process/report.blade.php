@extends("tenants.reports.template.report")

@section('title', 'Ficha Financeira de Processos (Analíticos)')

@section("body")
    <div id="corpo">
        <div style="width: 100%; text-align: center; font-size: 9px;">
            Datas: {{$data_ini}} até {{$data_end}}
        </div>
        <hr style="border:0.01mm solid #333" />
        <br />
        @php
            $total_global = 0;
        @endphp
        @forelse($datas as $data)
            <div style="border: 1px solid #333; padding: 5px;margin-bottom:5px;">{{$data->fantasy}} - {{$data->name}}</div>
            @php
                $total = 0;
                $quant = 0;
            @endphp
            @forelse($data->processes as $process)
                @php
                    $debito = 0;
                    $credito = 0;
                @endphp
                <table>
                    <tr>
                        <td colspan="4" style="padding-left:5px;padding-top:5px;border-bottom:0.01mm solid #333"><strong>Processo: </strong> {{$process->number_process}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left:5px;width:10%"><strong>Data</strong></td>
                        <td style="text-align:left"><strong>Descrição</strong></td>
                        <td style="text-align:center;width:10%"><strong>Tipo</strong></td>
                        <td style="text-align:right;width:10%"><strong>Valor</strong></td>
                    </tr>
                    @forelse($process->financials as $financial)
                        @php
                            if ($financial->type === "Receber") $credito += $financial->value;
                            if ($financial->type === "Pagar") $debito += $financial->value;
                        @endphp
                        <tr>
                            <td style="text-align:center;">{{$financial->due_date_br}}</td>
                            <td style="text-align:left;">{{$financial->description}}</td>
                            <td style="text-align:center;">{{$financial->type === "Receber" ? "Crédito": "Débito"}}</td>
                            <td style="text-align:right;margin-right:2px">{{App\Helpers\Helper::formatDecimal($financial->value,2)}}</td>
                        </tr>
                    @empty
                    @endforelse
                    <tr>
                        <td colspan="3" style="text-align:right;margin-right:5"><strong>SubTotal:</strong></td>
                        <td colspan="1" style="text-align:right;"><strong>{{App\Helpers\Helper::formatDecimal($credito - $debito,2)}}</strong></td>
                    </tr>
                    @php
                        $total += $credito - $debito;
                        $quant ++;
                    @endphp
                </table>
            @empty
                <div>Nenhum Processo</div>
            @endforelse
            <table style="margin-top: 10px; margin-bottom:10px">
                <tr>
                    <td style="text-align:right;"><strong>Quantidade de processos {{$quant}} no valor Total: {{App\Helpers\Helper::formatDecimal($total, 2)}}</strong></td>
                </tr>
            </table>
            @php
                $total_global += $total;
            @endphp
        @empty
        @endforelse
        <div style="width:100%; text-align:right; margin-top:20px; border-top:1px solid #111;padding-top:5px;">
            <strong>Total Geral:{{App\Helpers\Helper::formatDecimal($total_global, 2)}}</strong>
        </div>
    </div>
@endsection
