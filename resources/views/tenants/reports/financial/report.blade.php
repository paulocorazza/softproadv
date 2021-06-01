@extends("tenants.reports.template.report")

@section('title', 'Relatório de Contas A Pagar / Receber')

@section("body")
    <div id="corpo">
        <div style="width: 100%; text-align: center; font-size: 9px;">
            Datas: {{$data_ini}} até {{$data_end}}
        </div>
        <hr style="border:0.01mm solid #333"/>
        <br/>
        @php
            $total_global = 0;
        @endphp


        @forelse($datas as $index => $financials)
            <div style="border: 1px solid #333; padding: 5px;margin-bottom:5px;">{{$index}}</div>
            @php
                $total = 0;
            @endphp

            <table>
                <tr>
                    <td style="padding-left:5px;width:10%"><strong>Dt. Emissão</strong></td>
                    <td style="padding-left:5px;width:10%"><strong>Documento</strong></td>
                    <td style="text-align:left; width:40%"><strong>Pessoa</strong></td>
                    <td style="text-align:center;width:10%"><strong>Dt.Vencimento</strong></td>
                    <td style="text-align:center;width:10%"><strong>Dt.Pagamento</strong></td>
                    <td style="text-align:right;width:10%"><strong>Valor</strong></td>

                </tr>
                @forelse($financials as $financial)
                    @php
                        $debito = 0;
                        $credito = 0;
                    @endphp
                    @php
                        if ($financial->type === "Receber") $credito += $financial->value;
                        if ($financial->type === "Pagar") $debito += $financial->value;
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{$financial->created_at_br}}</td>
                        <td style="text-align:center;">{{$financial->document}}</td>
                        <td style="text-align:left;">{{$financial->person->name}}</td>
                        <td style="text-align:center;">{{$financial->due_date_br}}</td>
                        <td style="text-align:center;">{{$financial->payday_br}}</td>
                        <td style="text-align:right;margin-right:2px">{{App\Helpers\Helper::formatDecimal($financial->value,2)}}</td>

                    </tr>
                    @php
                        $total += $credito - $debito;
                    @endphp

                @empty
                    <div>Nenhum Lançamento</div>
                @endforelse
            </table>
            <table style="margin-top: 10px; margin-bottom:10px">
                <tr>
                    <td style="text-align:right;"><strong>Total a {{ $index }}
                            : {{App\Helpers\Helper::formatDecimal($total, 2)}}</strong></td>
                </tr>
            </table>
            @php
                $total_global += $total;
            @endphp
        @empty
        @endforelse
        <div style="width:100%; text-align:right; margin-top:20px; border-top:1px solid #111;padding-top:5px;">
            <strong>Total Geral: {{App\Helpers\Helper::formatDecimal($total_global, 2)}}</strong>
        </div>
    </div>
@endsection
