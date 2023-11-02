<form action="{{$group->id ? Route('groups.update', $group) : Route('groups.store')}}" class="maticpress-ajax-form" method="POST" data-modal-form="#maticpress-modal">
    @csrf
    @if($group->id)
    @method('PUT')
    @endif
    <div class="form-body">
        <div class="row">
            <div class="col-md-4">
                <label for="group_name">Group Name</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="text" id="group_name" class="form-control" name="name" placeholder="Group Name" value="{{$group->name}}">
            </div>
            <div class="col-md-4">
                <label for="group_description">Description</label>
            </div>
            <div class="col-md-8 form-group">
                <textarea class="form-control" name="description" id="group_description" rows="5" placeholder="Group Description">{{$group->description}}</textarea>
            </div>
            <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</form>