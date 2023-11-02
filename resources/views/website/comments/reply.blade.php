<form action="{{Route('wordpress.comments.save')}}" class="maticpress-ajax-form" method="POST" data-modal-form="#maticpress-modal">
    @csrf
    <input type="hidden" name="postid" value="{{$postid}}" />
    <input type="hidden" name="comment_id" value="{{$comment_id}}" />
    <input type="hidden" name="website_id" value="{{$website_id}}" />
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="comment" class="mb-2">Reply:</label>
                    <textarea name="comment" class="form-control" rows="10" autofocus="true"></textarea>
                </div>
            </div>
            <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</form>