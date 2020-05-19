<div class="user-panel">
    <ul class="list-inline">
        @foreach($users as $user)
            <li class="list-inline-item">
                @if( !empty($user['image']) )
                    <img src="{{ asset('storage/tenants/users/' . $user['image']) }}" alt="{{$user['name']}}"
                         class="user-dashboard img-circle">
                @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="SoftPro" class="user-dashboard img-circle">
                @endif
            </li>
        @endforeach
    </ul>
</div>
