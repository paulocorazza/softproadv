    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <div class="row">
                <div class="col-5">
                    <h4><strong>Audiências</strong></h4>
                </div>

            <div class="col-1"><span class="badge badge-danger">{{ $myAudiences->toArray()['total'] }}</span></div>

        </div>

        <div class="card-tools" id="links_audiences">
            <div class="pagination pagination-sm">{!! $myAudiences->links() !!}</div>
        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <ul class="todo-list ui-sortable" data-widget="todo-list">
            @forelse($myAudiences as $audience)
                <li>
                    <!-- drag handle -->
                    <span class="handle ui-sortable-handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo{{$audience->id}}"
                               id="todoCheck{{$audience->id}}" onclick="finishEvent({{$audience->id}})">
                        <label for="todoCheck1"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text">{{ $audience->title }}</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-danger"><i class="far fa-clock"></i>{{ $audience->days_diff }}
                    </small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <a href="{{ route('events.edit', $audience->id) }}">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </a>
                    </div>
                </li>
            @empty
                <span class="text">Nenhuma Audiência Cadastrada</span>
            @endforelse
        </ul>
    </div>
    <!-- /.card-body -->


