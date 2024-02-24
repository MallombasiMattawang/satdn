<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIMAP - ONLINE BULUKUMBA</title>
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
                    <div class="masthead-subheading">SCAN SURAT IZIN</div>
                    <div class="masthead-heading">Sistem Scan perizinan online DPMPTSP ini diperuntukkan bagi pemohon
                        yang ingin memastikan keaslian surat izin yang dikeluarkan DPMPTSP Kabupaten Bulukumba
                        silahkan masukan nomor surat ata
                        pendaftaran.</div>
                    <p>Cari Data Izin :</p>
                    <form action="{{ route('tracking.cari') }} " method="GET" class="form-prevent">
                        @csrf
                        <div class="form-group">
                            <div class="col-sm-7">
                                <input type="text" name="cari" class="form-control" placeholder="nomor registrasi..."
                                    required value="{{ old('cari') }}">
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
