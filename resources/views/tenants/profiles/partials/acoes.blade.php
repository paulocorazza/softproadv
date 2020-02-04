@can('update_profile')
    <a href="{{route('profiles.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_profile')
    <a href="{{route('profiles.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan

@can('view_profile_users')
    <a href="{{route('profiles.users', $id)}}" class="badge bg-blue">Usuários</a>
@endcan

@can('view_profile_permissions')
    <a href="{{route('profiles.permissions', $id)}}" class="badge bg-black">Permissões</a>
@endcan
