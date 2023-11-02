<x-app-layout>
    <div class="page-heading">
        <h3>{{$title}}</h3>
    </div> 
    <div class="page-content"> 
        <div class="mb-3 text-end">
            <button class="btn btn-sm btn-light" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

        <section>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p>Alexa Ranking: <span class="text-success">N/A</span></p>
                        </div>
                        <div>
                            <p>Domain Age: <span class="text-success">0 years 9 months and 18 days</span></p>
                        </div>
                        <div>
                            <p>Domain expiring on: 20 April 2019</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Generate robots.txt file
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary">Settings</button>
                            <button type="button" class="btn btn-success">Generate</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Broken Links Checker
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary">Settings</button>
                            <button type="button" class="btn btn-success">Manually Check Broken Links</button>
                        </div>
                    </div>
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
