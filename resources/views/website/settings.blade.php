<x-app-layout>
    @push('styles')
        <style>
           
        </style>
    @endpush
    <div class="page-heading">

        <h3>{{ $title }}</h3>
    </div>

    <div class="page-content"> 
        <div class="mb-3 text-end">
            <button class="btn btn-sm btn-light" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

        <section>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-custom-bg shadow updates-count" data-id="{{ generateSecureHash($website->id) }}"
                        data-url="{{ route('websites.check-updates', generateSecureHash($website->id)) }}">
                        <div class="card-body">
                            <p class="text-center my-3">
                                <i class="fas fa-sync-alt h1 rotate"></i>
                            </p>
                            <div class="text-center my-3">
                                <a href="{{ route('websites.wp-update', 'core-update') }}"
                                    class="badge bg-primary ml-1 mb-1" title="Click to update all core">
                                    Core <span class="badge bg-white text-dark core-count">0</span>
                                </a>
                                <a href="{{ route('websites.wp-update', 'theme-update') }}"
                                    class="badge bg-info ml-1 mb-1" title="Click to update all themes">
                                    Themes <span class="badge bg-white text-dark themes-count">0</span>
                                </a>
                                <a href="{{ route('websites.wp-update', 'plugin-update') }}"
                                    class="badge bg-success ml-1 mb-1" title="Click to update all plugins">
                                    Plugins
                                    <span class="badge bg-white text-dark plugins-count">0</span>
                                </a>
                            </div>

                            <div class="text-center">
                                <span>Wordpress Core, Themes, Plugins Updates Checker</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-custom-bg shadow">
                        <div class="card-body ssl-secure"
                            data-url="{{ route('websites.check-ssl', generateSecureHash($website->id)) }}">
                            <a href="{{ route('websites.update-ssl-permission', generateSecureHash($website->id)) }}">
                                <h6 class="text-center">SSL Secure</h6>
                                <p class="text-center my-3">
                                    <i class="fas fa-unlock-alt icon-size h1 ssl-view"></i>
                                </p>

                                <div class="text-center text-secondary">
                                    <span>HTTPS Protocol - Safe and Secure Browsing</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-custom-bg shadow">
                        <div class="card-body">
                            <a href="{{ Route('websites.settings.websecurity',generateSecureHash($website->id)) }}">
                                <h6 class="text-center">Web Security</h6>
                                <p class="text-center my-3">
                                    <i class="fas fa-key icon-size h1"></i>
                                </p>

                                <div class="text-center text-secondary">
                                    <span>Security - Safe and Secure Website</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-custom-bg shadow">
                        <div class="card-body">
                            <a href="{{Route('websites.settings.dboptimization')}}">
                                <h6 class="text-center">DB Optimization</h6>
                                <p class="text-center my-3">
                                    <i class="fas fa-broom icon-size h1"></i>
                                </p>

                                <div class="text-center text-secondary">
                                    <span>Quickly Cleanup Your Database</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-custom-bg shadow">
                        <div class="card-body">
                            <a href="{{Route('websites.settings.seo')}}">
                                <h6 class="text-center">SEO</h6>
                                <p class="text-center my-3">
                                    <i class="fas fa-bullhorn icon-size h1"></i>
                                </p>

                                <div class="text-center text-secondary">
                                    <span>Wordpress Website for SEO</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-custom-bg shadow">
                        <div class="card-body">
                            <a href="#">
                                <h6 class="text-center">Site Moniter</h6>
                                <p class="text-center my-3">
                                    <i class="fas fa-microchip icon-size h1"></i>
                                </p>

                                <div class="text-center text-secondary">
                                    <span>Website is up and running</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-custom-bg shadow">
                        <div class="card-body">
                            <a href="#">
                                <h6 class="text-center">Marketing</h6>
                                <p class="text-center my-3">
                                    <i class="fas fa-poll-h icon-size h1"></i>
                                </p>

                                <div class="text-center text-secondary">
                                    <span>List of marketing elements enabled on this website</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

            });
        </script>
    @endpush
</x-app-layout>
