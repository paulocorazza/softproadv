@can('update_city')
    <a href="{{route('cities.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_city')
    <a href="{{route('cities.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
