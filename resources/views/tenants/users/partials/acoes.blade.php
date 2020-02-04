@can('update_user')
    <a href="{{route('users.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_user')
<a href="{{route('users.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan

@can('view_user_profile')
<a href="{{route('users.profiles', $id)}}" class="badge bg-blue">Perfis</a>
@endcan
