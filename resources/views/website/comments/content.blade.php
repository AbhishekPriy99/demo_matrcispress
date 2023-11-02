@forelse ($websites as $website)
<div class="col-md-3">
    <div class="card card-custom-bg shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3 w-50">
                <a href="{{Route('wordpress.comments.lists', $website->id)}}">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <p class="text-nowrap text-truncate">URL: {{$website->url}}</p>
            <p class="text-nowrap text-truncate w-75">Key: {{$website->key}} </p>
        </div>
    </div>
</div>
@empty
    
@endforelse