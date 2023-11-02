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
                            Hide Login
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary login-settings" data-bs-toggle="collapse" href="#login-settings-form" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                                Settings
                            </button>
                            
                            <button type="button" class="btn btn-primary login-status"
                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Checking Status"
                                data-updating-text="<i class='fa fa-spinner fa-spin '></i> Updating Status"
                                data-url="{{ route('websites.check-login-status', $website_id) }}"
                                data-update-url="{{ route('websites.update-login-status', $website_id) }}">
                                <i class='fa fa-spinner fa-spin '></i> Checking Status
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center pt-2">
                        <div class="collapse" id="login-settings-form">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('websites.update-login-url', $website_id) }}" class="maticpress-ajax-form" method="POST">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3">Login url: {{ $website->url }}/ </span>
                                            <input type="text" class="form-control" name="wp_login_url" aria-label="Text input with segmented dropdown button">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                          </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Limit Login
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary">Settings</button>
                            <button type="button" class="btn btn-success">Enable</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Change Login Username
                        </div>
                        <div>
                            {{-- <button type="button" class="btn btn-primary">Setting</button> --}}
                            <button type="button" class="btn btn-primary update-login-username" data-bs-toggle="collapse" href="#update-username-form" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                                Settings
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center pt-2">
                        <div class="collapse" id="update-username-form">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('websites.update-login-username', $website_id) }}" class="maticpress-ajax-form" method="POST" >
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3">New Login Username: </span>
                                            <input type="text" class="form-control" name="new_login_username" >
                                            <button type="submit" class="btn btn-primary">Update</button>
                                          </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Change Database Table Prefix
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary table-prefix" data-bs-toggle="collapse" href="#table-prefix-form" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                                Settings
                            </button>
                           
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center pt-2">
                        <div class="collapse" id="table-prefix-form">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('websites.update-table-prefix', $website_id) }}" class="maticpress-ajax-form" method="POST">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3">New Table Prefix: </span>
                                            <input type="text" class="form-control" name="table_prefix" >
                                            <button type="submit" class="btn btn-primary">Update</button>
                                          </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
        
                function checkLoginStatus() {
                    $.ajax({
                        url: $(".login-status").data("url"),
                        type: "POST",
                        beforeSend: function() {
                            $(".login-status").html($(".login-status").data('loading-text'));
                        },
                        success: function(res) {
                            if (res.SUCCESS) {
                                if (res.status == 1) {
                                    $(".login-status").attr('class','btn btn-danger login-status');
                                    $(".login-status").html('Disable');
                                } else {
                                    $(".login-status").attr('class','btn btn-success login-status');
                                    $(".login-status").html('Enable');
                                }
                            } else {
                                $(".login-status").attr('class','btn btn-warning login-status');
                                $(".login-status").html('<i class="fas fa-exclamation-triangle"></i> Status checking failed!');
                            }
                            if(res.DATA){
                                $(`input[name="wp_login_url"]`).val(res.DATA);
                            }
                        },
                        complete: function() {},
                    });
                }

                $('body').on('click', '.login-status', function(e) {
                    $.ajax({
                        url: $(".login-status").data("update-url"),
                        type: "POST",
                        beforeSend: function() {
                            $(".login-status").html($(".login-status").data('updating-text'));
                        },
                        success: function(res) {
                            checkLoginStatus()
                        }
                    });
                })

                setTimeout(() => {
                    checkLoginStatus();
                }, 200);
            });
        </script>
    @endpush
</x-app-layout>
