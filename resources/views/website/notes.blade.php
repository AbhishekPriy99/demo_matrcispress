@if (empty($data))
<form action="{{Route('websites.notes',generateSecureHash($website_id))}}" class="maticpress-ajax-form" method="POST" data-modal-form="#maticpress-modal" reload-content="true">
    @csrf
    <div class="form-body">
        <div class="row">
            <span>{{!empty($data)?$data->created_at:''}}</span>
            <div class="col-sm-12 form-goad-croup">
                <textarea name="notes" id="" cols="30" rows="10" class="form-control" placeholder="Add your notes here...">{{!empty($data)?$data->notes:''}}</textarea>
            </div>
            <div class="col-sm-12 d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</form>
@else
@forelse ($data as $each)
<div class="card m-0">
    <form action="{{Route('websites.notes',generateSecureHash($each->id))}}" class="maticpress-ajax-form update" method="POST">
        @csrf
        @method('patch')
        <input type="hidden" name="website_id" value="{{$website_id}}"> 
        <div class="d-flex justify-content-between align-items-center px-1" style="background: lavender; height:25px;"><span>{{$each->created_at}}</span><span><button type="submit"  class="btn text-primary ms-2"> <i class="fas fa-edit"></i></button><a href="{{Route('websites.notes',generateSecureHash($each->id))}}" class="text-danger ms-2 maticpress-delete" reload-content="true"> <i class="fas fa-trash"></i></a></span></div>
        <div class="card-body p-0">
            <textarea name="notes" id="" cols="30" rows="5" class="form-control">{{$each->notes}}</textarea>
        </div>
    </form>
</div>
<hr>
@empty
@endforelse
@endif