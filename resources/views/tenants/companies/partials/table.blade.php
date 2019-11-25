<div class="box box-danger">
    <div class="box-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">SubDomínio</th>
                <th width="150px" scope="col">Ações</th>
            </tr>
            </thead>

            <tbody>
            @forelse($companies as $company)
                <tr>
                    <th scope="row">{{ $company->id }}</th>
                    <td>{{$company->name}}</td>
                    <td>{{$company->subdomain}}</td>
                    <td>
                        <a href="{{route('companies.edit', $company->id)}}" class="badge bg-yellow">Editar</a>
                        <a href="{{route('companies.show', $company->id)}}" class="badge bg-dark">Detalhes</a>
                    </td>
                </tr>

            @empty
                <tr>
                    Nenhum Registro nesta tabela
                </tr>
            @endforelse
            </tbody>
        </table>

        @if( isset($dataForm) )
            {!! $companies->appends($dataForm)->links() !!}
        @else
            {!! $companies->links() !!}
        @endif
    </div>
</div>


