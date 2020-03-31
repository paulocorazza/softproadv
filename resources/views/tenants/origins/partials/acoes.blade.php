@can('update_origin')
    <a href="{{route('origins.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_origin')
    <a href="{{route('origins.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
