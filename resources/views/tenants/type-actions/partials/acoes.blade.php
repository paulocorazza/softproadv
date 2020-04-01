@can('update_type_action')
    <a href="{{route('type-actions.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_type_action')
    <a href="{{route('type-actions.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
