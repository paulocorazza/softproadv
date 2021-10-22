@can('update_meet')
    <a href="{{route('meets.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_meet')
    <a href="{{route('meets.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
