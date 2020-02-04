@can('update_permission')
    <a href="{{route('permissions.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_permission')
    <a href="{{route('permissions.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan

@can('view_permission_profile')
    <a href="{{route('permissions.profiles', $id)}}" class="badge bg-blue">Perfis</a>
@endcan
