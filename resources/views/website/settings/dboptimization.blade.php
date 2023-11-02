<x-app-layout>
    <div class="page-heading">
        <h3>{{$title}}</h3>
    </div> 
    <div class="page-content"> 

        <div class="mb-3 text-end">
            <button class="btn btn-sm btn-light" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

        {{-- post optimization --}}
        <section>
            <div class="card">
                <div class="card-header">
                    <h4>Post Optimization</h4>
                    <p>There are a total of <strong>4 Posts</strong>  and <strong>2 Post Meta</strong>.</p>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="w-50">Details</th>
                                <th>Count</th>
                                <th>% Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Revision</td>
                                <td>10</td>
                                <td class="text-bold-500">10%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Auto Drafts</td>
                                <td>10</td>
                                <td class="text-bold-500">10%</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-times"></i> clear</button>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Details</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Deleted Posts</td>
                                <td>10</td>
                                <td class="text-bold-500">10%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Orphaned Post Meta</td>
                                <td>10</td>
                                <td class="text-bold-500">10%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Duplicated Post Meta</td>
                                <td>10</td>
                                <td class="text-bold-500">10%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">oEmbed Caches in Post Meta</td>
                                <td>10</td>
                                <td class="text-bold-500">10%</td>
                                <td>N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Comment optimization --}}
        <section>
            <div class="card">
                <div class="card-header">
                    <h4>Comment Optimization</h4>
                    <p>There are a total of <strong>4 Comments</strong>  and <strong>0 Comment Meta</strong>.</p>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="w-50">Details</th>
                                <th>Count</th>
                                <th>% Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Unapproved Comments</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Spammed Comments</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Deleted Comments</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Orphaned Comment Meta</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Duplicated Comment Meta</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- User Data optimization --}}
        <section>
            <div class="card">
                <div class="card-header">
                    <h4>User Data Optimization</h4>
                    <p>There are a total of <strong>4 Users</strong>  and <strong>18 User Meta</strong>.</p>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="w-50">Details</th>
                                <th>Count</th>
                                <th>% Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Orphaned User Meta</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Duplicated User Meta</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Terms Data optimization --}}
        <section>
            <div class="card">
                <div class="card-header">
                    <h4>User Data Optimization</h4>
                    <p>There are a total of <strong>1 Terms, 0 Terms Meta, 1 Term Taxonomy</strong>  and <strong>1 Term Relationships</strong>.</p>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="w-50">Details</th>
                                <th>Count</th>
                                <th>% Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Orphaned Term Meta</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Duplicated Term Meta</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Orphaned Term Relationship</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">
                                    Unused Terms <br/>
                                    <small>Note that some unused terms might belong to draft posts that have not been published yet. only sweep this when you do not have any draft posts.</small>
                                </td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Options Data optimization --}}
        <section>
            <div class="card">
                <div class="card-header">
                    <h4>Options Data Optimization</h4>
                    <p>There are a total of <strong>130 Options</strong>.</p>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="w-50">Details</th>
                                <th>Count</th>
                                <th>% Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Transient Option</td>
                                <td>0</td>
                                <td class="text-bold-500">0%</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-times"></i> clear</button>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Database optimization --}}
        <section>
            <div class="card">
                <div class="card-header">
                    <h4>Database Optimization</h4>
                    <p>There are a total of <strong>13 Tables</strong>.</p>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="w-50">Details</th>
                                <th>Count</th>
                                <th>% Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Users</td>
                                <td>100</td>
                                <td class="text-bold-500">100%</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-times"></i> clear</button>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
