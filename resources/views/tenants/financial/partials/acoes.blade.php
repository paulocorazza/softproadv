@can('update_financial')
    <a href="{{route('financial.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_financial')
    <a href="{{route('financial.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
