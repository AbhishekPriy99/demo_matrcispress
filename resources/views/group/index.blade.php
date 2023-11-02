<x-app-layout>
    <div class="page-heading">
        <h3>{{$title}}</h3>
    </div> 
    <div class="page-content"> 
        <section class="text-end mb-4">
            <a href="{{route('groups.create')}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#maticpress-modal" data-bs-whatever="Add Group">
                <i class="fas fa-plus"></i> Add New Group
            </a>
        </section>
        <section>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Groups Lists</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="maticpress-datatable" data-route="{{Route('groups.datatable')}}">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
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
            initServerSideDatatable({
                "target" : '#maticpress-datatable',
                "route" : $('#maticpress-datatable').attr('data-route'),
                "searchTerm" : function(d) {
                                d.search = $('input[name=search]').val();
                            },
                "columns" : [{
                                data: 'name',
                                name: 'name',
                            },
                            {
                                data: 'description',
                                name: 'description'
                            },
                            {
                                data: 'actions',
                                responsivePriority: -1
                            }],
                "order" : [
                            [0, "desc"]
                        ]
            });
        });
    </script>
    @endpush
</x-app-layout>
