<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIAP - ONLINE BULUKUMBA</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/landing-page/favicon.ico" />

    @include('layouts.landing-page.stylesheet')
    <style>
        /* untuk menghilangkan spinner  */
        .spinner {
            display: none;
        }

    </style>

</head>

<body id="page-top">
    <!-- Navigation-->
    @include('layouts.landing-page.navbar-track')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="row">
                <div class="col-md-5 " style="">
                    <img class="img-fluid" src="{{ asset('assets/landing-page/img/logos/splash1.png') }}"
                        alt="..." />
                </div>
                <div class="col-md-7">
                    <div class="masthead-subheading">VALIDASI DOKUMEN IZIN</div>
                    <div class="masthead-heading">
                        Silahkan unggah file dokumen PDF surat izin kamu yang akan divalidasi
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
                    <p>Dokumen Izin PDF :</p>
                    <form action="{{ route('validasi.validasi_pdf') }} " method="post" class="form-prevent" enctype="multipart/form-data">
                        
                        @csrf
                        <div class="form-group">
                            <div class="col-sm-7">
                                <input type="file" name="signed_file" class="form-control" required>
                                <div class="form-group row">
                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                                    <div class="col-md-12 captcha">
                                        <span>{!! captcha_img() !!}</span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="captcha" class="col-md-12 col-form-label text-md-right">Enter
                                        Captcha</label>
                                    <div class="col-md-6">
                                        <input id="captcha" type="text" class="form-control" name="captcha">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-danger btn-lg button-prevent">
                                    <div class="spinner"><i role="status"
                                            class="spinner-border spinner-border-sm"></i> Proses tracking... </div>
                                    <div class="hide-text">Cari</div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>


        </div>
    </header>


    @include('layouts.landing-page.footer')

    @include('layouts.landing-page.javascript')
    <script>
        // jika form-prevent disubmit maka disable button-prevent dan tampilkan spinner
        (function() {
            $('.form-prevent').on('submit', function() {
                $('.button-prevent').attr('disabled', 'true');
                $('.spinner').show();
                $('.hide-text').hide();
            })
        })();
    </script>
</body>

</html>
