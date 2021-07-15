@can('update_contract')
    <a href="{{route('contracts.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_contract')
    <a href="{{route('contracts.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
