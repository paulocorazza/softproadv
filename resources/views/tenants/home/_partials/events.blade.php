<div class="card-header ui-sortable-handle" style="cursor: move;">
    <h5 class="d-inline"><strong>Minhas Atividades </strong></h5>
    <span class="d-inline badge badge-danger">{{ $myEvents->toArray()['total'] }}</span>

    <div class="card-tools" id="links_events">
        <div class="pagination pagination-sm">{!! $myEvents->links() !!}</div>
    </div>

</div>
<!-- /.card-header -->
<div class="card-body">
    <table class="table table-borderless table-hover">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($myEvents as $event)
            <tr>
                <td>
                    <input type="checkbox" value="" name="todo{{$event->id}}"
                           id="todoCheck{{$event->id}}" onclick="finishEvent({{$event->id}})">
                </td>
                <td>{{ $event->title_limit }}</td>
                <td><small class="badge badge-danger"><i class="far fa-clock"></i>{{ $event->days_diff }}
                    </small></td>
                <td>
                    <a href="{{ route('events.edit', $event->id) }}">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                    </a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

</div>
<!-- /.card-body -->

