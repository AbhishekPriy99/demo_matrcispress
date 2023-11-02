<x-app-layout>
    <div class="page-heading">
        <h3>{{$title}}</h3>
    </div> 
    <div class="page-content"> 
        <section class="text-end mb-4">
            <a href="{{route('websites.create')}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#maticpress-modal" data-bs-whatever="Register New Website">
                <i class="fas fa-plus"></i> Register New Website
            </a>
        </section>
        <section>
            <input type="hidden" name="maticpress-content-url" value="{{Route('websites.content')}}">
            <div class="row maticpress-content">
                
            </div>
        </section>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function(){
            
        });
    </script>
    @endpush
</x-app-layout>
