@can('update_financial_account')
    <a href="{{route('financial-account.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_financial_account')
    <a href="{{route('financial-account.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
