@extends("tenants.reports.template.report")

@section('title', 'Honorários')

@section("body")
    <div id="corpo">
        <div style="width: 100%; text-align: center; font-size: 9px;">
            Datas: {{$data_ini}} até {{$data_end}}
        </div>
        <hr style="border:0.01mm solid #333" />
        <br />
        <table>
            <tr>
                <th style="text-align:left;"><strong>Documento</strong></th>
                <th style="text-align:left"><strong>Cliente</strong></th>
                <th style="text-align:center;width:10%"><strong>Tipo</strong></th>
                <th style="text-align:right;width:10%"><strong>Valor</strong></th>
            </tr>

            @php
                $debito = 0;
                $credito = 0;
            @endphp

            @forelse($honorarys as $honorary)
            @php
                if ($honorary->type === "Receber") $credito += $honorary->value;
                if ($honorary->type === "Pagar") $debito += $honorary->value;
            @endphp

            <tr>
                <td style="text-align:left;">{{$honorary->document }}</td>
                <td style="text-align:left;">{{$honorary->person->name}}</td>
                <td style="text-align:center;">{{$honorary->type === "Receber" ? "Crédito": "Débito"}}</td>
                <td style="text-align:right;margin-right:2px">{{App\Helpers\Helper::formatDecimal($honorary->value,2)}}</td>
            </tr>

            @empty
                <div>Nenhum honorário</div>
            @endforelse

            <tr>
                <td colspan="3" style="text-align:right;margin-right:5"><strong>SubTotal:</strong></td>
                <td colspan="1"
                    style="text-align:right;">
                    <strong>{{App\Helpers\Helper::formatDecimal($credito - $debito,2)}}</strong>
                </td>
            </tr>
        </table>
    </div>
@endsection
