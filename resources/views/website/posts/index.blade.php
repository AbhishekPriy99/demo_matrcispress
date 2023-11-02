<x-app-layout>
    <div class="page-heading">
        <h3>{{$title}}</h3>
    </div> 
    <div class="page-content"> 
        <section>
            <input type="hidden" name="maticpress-content-url" value="{{Route('wordpress.posts.content')}}">
            <div class="row maticpress-content">
                
            </div>
        </section>
    </div>

</x-app-layout>
