@extends('layouts.auth')

@section('content')

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="{{ asset('assets/auth-page/images/splash3.png') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign Up <strong>SIAP-ONLINE</strong></h3>
                                <p class="mb-4">DPMPTSP Kabupaten
                                    Bulukumba</p>
                            </div>
                            <form class="form-prevent" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group first">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="form-group row">
                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                                    <div class="col-md-12 captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Enter Captcha</label>
                                    <div class="col-md-6">
                                        <input id="captcha" type="text" class="form-control" name="captcha">
                                    </div>
                                </div>

                                <button type="submit" class="btn text-white btn-block btn-warning button-prevent">
                                    <div class="spinner"><i role="status"
                                            class="spinner-border spinner-border-sm"></i> Loading... </div>
                                    <div class="hide-text">Register</div>
                                </button>

                                <span class="d-block text-left my-4 text-muted"> Atau Sudah punya akun <a
                                        class="" href="{{ route('login') }}">{{ __('Login') }}</a></span>
                            </form>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <br />
                            @endif
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
@endpush
