<form action="{{$website->id ? Route('websites.update', $website) : Route('websites.store')}}" class="maticpress-ajax-form" method="POST" data-modal-form="#maticpress-modal" reload-content="true">
    @csrf
    @if($website->id)
    @method('PUT')
    @endif
    <div class="form-body">
        <div class="row">
            <div class="col-md-4">
                <label for="url">Website URL</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="url" id="url" class="form-control" name="url" placeholder="Website URL" value="{{$website->url}}">
            </div>
            <div class="col-md-4">
                <label for="key">Website Key</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="text" id="key" class="form-control" name="key" placeholder="Website Key" value="{{$website->key}}">
            </div>
            <div class="col-md-4">
                <label for="group_description">Group Name</label>
            </div>
            <div class="col-md-8 form-group">
                <select class="form-select" id="group_id" name="group_id">
                    <option value="">Select Group</option>
                    @forelse ($groups as $group)
                        <option value="{{$group->id}}" {{$group->id==$website->group_id ? 'selected' : ''}}>{{$group->name}}</option>
                    @empty
                        <option value="">Groups not available.</option>
                    @endforelse
                </select>
            </div>
            <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</form>