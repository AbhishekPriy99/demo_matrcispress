<table class="table table-hover mb-0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if( isset($response->DATA) )
        @forelse($response->DATA as $data)
        <tr>
            <td>{{ $data->first_name.' '.$data->last_name }}</td>
            <td>{!! $data->email !!}</td>
            <td>{{ implode(",",$data->roles) }}</td>
            <td>
                <div class="form-check form-switch form-switch-success mx-2">
                    <input class="form-check-input form-check-success maticpress-change-status" type="checkbox" id="comment-status" >
                    <label class="form-check-label" for="comment-status"></label>
                </div>
            </td>
            <td>
            <a href="{{route('wordpress.users.updateModal',[$data->id,$website_id])}}" class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#maticpress-modal" data-bs-whatever="Update User"></a>
                <a href="{{Route('wordpress.users.delete', [$data->id, $website_id])}}" class="text-danger ms-2 maticpress-delete" reload-content="true">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        @empty
        @endforelse
        @endif
    </tbody>
</table>