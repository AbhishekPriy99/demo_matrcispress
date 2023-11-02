<x-app-layout>
    <div class="page-heading">
        <h3>{{$title}}</h3>
    </div> 
    <div class="page-content"> 
        <div class="d-flex justify-content-end align-items-center mb-3">
            <button class="btn btn-sm btn-light" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

        <section>
            <input type="hidden" name="maticpress-content-url" value="{{Route('wordpress.comments.listscontent', generateSecureHash($website))}}">
            <div class="card">
                <div class="card-body maticpress-content"> 

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
