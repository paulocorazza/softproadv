    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h4><strong>Minhas Atividades </strong><span class="badge badge-danger">{{ $myEvents->toArray()['total'] }}</span></h4>

        <div class="card-tools" id="links_events">
            <div class="pagination pagination-sm">{!! $myEvents->links() !!}</div>
        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <ul class="todo-list ui-sortable" data-widget="todo-list">
            @forelse($myEvents as $event)
                <li>
                    <!-- drag handle -->
                    <span class="handle ui-sortable-handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo{{$event->id}}"
                               id="todoCheck{{$event->id}}" onclick="finishEvent({{$event->id}})">
                        <label for="todoCheck1"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text">{{ $event->title }}</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-danger"><i class="far fa-clock"></i>{{ $event->days_diff }}
                    </small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <a href="{{ route('events.edit', $event->id) }}">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </a>
                    </div>
                </li>
            @empty
                <span class="text">Nunhuma Atividade Cadastrada</span>
            @endforelse
        </ul>
    </div>
    <!-- /.card-body -->

