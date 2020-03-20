@can('update_country')
    <a href="{{route('countries.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_country')
    <a href="{{route('countries.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
