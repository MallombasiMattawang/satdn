@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br><br><br>
            <div class="card">
           
                <div class="card-header">{{ __('Verifikasi Email anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link verifikasi sudah kami kirim ke email anda') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan, harap periksa email Anda untuk lalu klik tautan verifikasi.') }}
                    {{ __('Jika Anda tidak menerima email silahkan cek di folder SPAM email anda atau ') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik disini untuk request ulang') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
