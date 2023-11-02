@forelse ($websites as $website)
<div class="col-md-3">
    <div class="card card-custom-bg shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3 w-50">
                <a href="{{Route('websites.admin-login', generateSecureHash($website->id))}}" target="_blank" class="text-primary ms-2" > 
                    <i class="fas fa-sign-in-alt"></i>
                </a>
                <a href="{{Route('websites.notes', generateSecureHash($website->id)).'?type=Add'}}" data-bs-toggle="modal" data-bs-target="#maticpress-modal" data-bs-whatever="Add Notes"><i class="fas fa-plus"></i></a>  
                <a href="{{Route('websites.notes', generateSecureHash($website->id)).'?type=Show'}}" data-bs-toggle="modal" data-bs-target="#maticpress-modal" data-bs-whatever="Show Notes"> <i class="far fa-copy"></i></a>  
                <a href="{{Route('websites.destroy', $website)}}" class="text-danger ms-2 maticpress-delete" reload-content="true"> 
                    <i class="fas fa-trash"></i> 
                </a>
            </div>
            <p class="text-nowrap text-truncate">URL: {{$website->url}}</p>
            <div class="d-flex">
                <p class="text-nowrap text-truncate w-75">Key: {{$website->key}} </p>
                <a href="{{Route('websites.edit', $website)}}" class="text-info" data-bs-toggle="modal" data-bs-target="#maticpress-modal" data-bs-whatever="Edit Website"> <i class="fas fa-edit"></i> </a>
            </div>
            <p>
                <a href="{{Route('websites.show', $website)}}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-plus"></i> More Settings
                </a>
            </p>
        </div>
    </div>
</div>
@empty
    
@endforelse