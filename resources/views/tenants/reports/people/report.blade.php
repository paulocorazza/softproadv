@extends("tenants.reports.template.report")

@section('title', 'Lista de Pessoas')

@section("body")
    <div id="corpo" class="container">
        <hr style="border:0.01mm solid #333"/>
        <br/>
        @forelse($people as $person)
            <table>
                <tr>
                    <td style="text-align:left"><strong>Código: </strong> {{ $person->id }}</td>
                    <td style="text-align:left"><strong>CPF: </strong> {{ $person->cpf  }}</td>
                    <td style="text-align:left"><strong>CNPJ: </strong> {{ $person->cnpj  }}</td>
                </tr>
                @foreach($person->addresses as $address)
                    <tr>
                        <td style="text-align:left"><strong>Tipo de Endereço: </strong>{{ $address->type_address->description }}</td>
                    </tr>
                    <tr>

                        <td style="text-align:left"><strong>Endereço: </strong> {{ $address->street }}</td>
                        <td style="text-align:left"><strong>Nº: </strong> {{ $address->number  }}</td>
                        <td style="text-align:left"><strong>Complemento: </strong> {{ $address->complement  }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><strong>Bairro: </strong> {{ $address->district }}</td>
                        <td style="text-align:left"><strong>Cidade: </strong> {{ $address->city->title  }}</td>
                        <td style="text-align:left"><strong>UF: </strong> {{ $address->state->letter  }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><strong>Cep: </strong> {{ $address->cep }}</td>
                        <td style="text-align:left"><strong>Telefone: </strong> {{ $person->telephone  }}</td>
                    </tr>
                    <br>
                    <hr style="border:0.01mm solid #333"/>
                @endforeach
            </table>
        @empty
            <h1>Nenhuma Pessoa</h1>
        @endforelse
    </div>
@endsection

