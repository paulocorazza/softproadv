@can('update_cities')
    <a href="{{route('city.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_cities')
    <a href="{{route('city.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
