@can('update_group_action')
    <a href="{{route('group-actions.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_group_action')
    <a href="{{route('group-actions.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
