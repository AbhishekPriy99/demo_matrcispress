<x-app-layout>
    <div class="page-heading">
        <h3>{{$title}}</h3>
    </div> 
    <div class="page-content"> 
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="btn btn-primary collapsed" data-bs-toggle="collapse" href="#maticpress-collapse" role="button" aria-expanded="false" aria-controls="maticpress-collapse">
                Create Posts
            </a>
            <button class="btn btn-sm btn-light" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

        <section>
            <div class="card collapse" id="maticpress-collapse" style="">
                <div class="card-body">
                    <form action="{{Route('wordpress.posts.save')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" class="form-control" name="title" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="post-content">Post Content</label>
                                    <textarea class="form-control" name="post_content" id="maticpress-editor" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories">Categories</label>
                                    <select class="choices form-select" name="categories">
                                        <option value="square">Square</option>
                                        <option value="rectangle">Rectangle</option>
                                        <option value="rombo">Rombo</option>
                                        <option value="romboid">Romboid</option>
                                        <option value="trapeze">Trapeze</option>
                                        <option value="traible">Triangle</option>
                                        <option value="polygon">Polygon</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories">Tags</label>
                                    <select class="choices form-select" name="tags">
                                        <option value="square">Square</option>
                                        <option value="rectangle">Rectangle</option>
                                        <option value="rombo">Rombo</option>
                                        <option value="romboid">Romboid</option>
                                        <option value="trapeze">Trapeze</option>
                                        <option value="traible">Triangle</option>
                                        <option value="polygon">Polygon</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="first-name-vertical">Featured Image</label>
                                    <input class="form-control" id="featured-image" type="file" name="featured-image">
                                </div>

                                <div class="my-5">
                                    <button type="submit" class="btn btn-primary"> Save </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="w-50">Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function(){
            new Quill("#maticpress-editor", {
                bounds: "#full-container .editor",
                modules: {
                    toolbar: [
                    [{ font: [] }, { size: [] }],
                    ["bold", "italic", "underline", "strike"],
                    [{ color: [] }, { background: [] }],
                    [{ script: "super" }, { script: "sub" }],
                    [
                        { list: "ordered" },
                        { list: "bullet" },
                        { indent: "-1" },
                        { indent: "+1" },
                    ],
                    ["direction", { align: [] }],
                    ["link", "image", "video"],
                    ["clean"],
                    ],
                },
                theme: "snow",
            });
        });
    </script>
    @endpush
</x-app-layout>
