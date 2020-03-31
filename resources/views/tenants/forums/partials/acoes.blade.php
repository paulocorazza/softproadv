@can('update_forum')
    <a href="{{route('forums.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_forum')
    <a href="{{route('forums.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
