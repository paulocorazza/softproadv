<div class="card-header ui-sortable-handle" style="cursor: move;">
    <h5 class="d-inline"><strong>Audiências</strong></h5>
    <div class="card-tools" id="links_audiences">
        <div class="pagination pagination-sm">{!! $myAudiences->links() !!}</div>
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
        @foreach($myAudiences as $audience)
            <tr>
                <td>
                    <input type="checkbox" value="" name="todo{{$audience->id}}"
                           id="todoCheck{{$audience->id}}" onclick="finishEvent({{$audience->id}})">
                </td>
                <td>{{ $audience->title_limit }}</td>
                <td>
                    <small class="badge badge-danger"><i class="far fa-clock"></i>{{ $audience->days_diff }}
                    </small>
                </td>
                <td>
                    <a data-toggle="modal" data-target=".modal-audience" data-id="{{ $audience->id }}"
                       href="javascript:;" onclick="editDetailAudience(this)">
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


