<table class="table table-hover mb-0">
    <thead>
        <tr>
            <th>Author</th>
            <th class="w-50">Comment</th>
            <th>In Response To</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if( isset($response->DATA) )
            @forelse($response->DATA as $data)
            <tr>
                <td>{{ $data->comment_author }}</td>
                <td>{!! $data->comment_content !!}</td>
                <td>{{ $data->comment_post_titles }}</td>
                <td>
                    <div class="form-check form-switch form-switch-success mx-2">
                        <input class="form-check-input form-check-success maticpress-change-status" type="checkbox" id="comment-status" {{$data->comment_approved?'checked' : ''}} data-url="{{Route('wordpress.comments.status', [$data->comment_ID, ($data->comment_approved?'0':'1'), $website_id])}}">
                        <label class="form-check-label" for="comment-status"></label>
                    </div>
                </td>
                <td>{{ date('d-m-Y', strtotime($data->comment_date)) }}</td>
                <td>
                    <a href="{{Route('wordpress.reply.form', [$data->comment_post_ID, $data->comment_ID, $website_id])}}" class="text-info ms-2" data-bs-toggle="modal" data-bs-target="#maticpress-modal" data-bs-whatever="Reply to {{$data->comment_author}}"> 
                        <i class="fas fa-reply"></i>
                    </a>
                    <a href="#" class="text-dark ms-2"> 
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{Route('wordpress.comments.delete', [$data->comment_ID, $website_id])}}" class="text-danger ms-2 maticpress-delete" reload-content="true"> 
                        <i class="fas fa-trash"></i>
                    </a>
                </td> 
            </tr>
            @empty
            @endforelse
        @endif
    </tbody>
</table>