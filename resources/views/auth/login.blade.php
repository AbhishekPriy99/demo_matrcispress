<x-guest-layout>
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html"><img src="{{asset('assets/compiled/svg/logo.svg')}}" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                @if($errors->has('email') || $errors->has('password'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('email') ?? $errors->first('password') }}</strong>
                    </span>
                @endif
    
                <form method="POST" action="{{ route('login') }}" class="maticpress-ajax-form">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Username" name="email" value="{{old('email')}}" autofocus autocomplete="username" required>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required autocomplete="current-password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="remember"  name="remember">
                        <label class="form-check-label text-gray-600" for="remember">
                            Keep me logged in
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    {{-- <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                            up</a>.</p> --}}
                    <p>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-bold">
                                {{ __('I forgot my password') }}
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
    
            </div>
        </div>
    </div>
</x-guest-layout>
