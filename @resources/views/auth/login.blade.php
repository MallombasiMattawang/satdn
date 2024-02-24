@extends('layouts.auth')

@section('content')


    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="{{ asset('assets/auth-page/images/splash2.png') }}" alt="Image"
                        class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In <strong>SIAP-ONLINE</strong></h3>
                                <p class="mb-4">DPMPTSP Kabupaten
                                    Bulukumba</p>
                            </div>
                            <form class="form-prevent" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group first">
                                    <label for="email">E-Mail</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span
                                            class="caption">{{ __('Remember Me') }}</span>
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <div class="control__indicator"></div>
                                    </label>
                                    @if (Route::has('password.request'))
                                        <span class="ml-auto">
                                            <a class="forgot-pass" href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        </span>
                                    @endif
                                    
                                </div>

                                <button type="submit" class="btn text-white btn-block btn-warning button-prevent">
                                    <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i> Loading... </div>
                                    <div class="hide-text">Log-in</div>
                                </button>  



                                <span class="d-block text-left my-4 text-muted"> Atau Buat akun di <a class="" href="{{ route('register') }}">{{ __('Register') }}</a></span>

                                
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
