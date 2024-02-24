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
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        /* untuk menghilangkan spinner  */
        .spinner {
            display: none;
        }

        .container2 {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;

            width: 100%;
            margin-bottom: 60px;
            margin-top: 50px;


        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;

            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            margin-left: 10px;
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
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

                <div class="col-md-12">
                    <div class="masthead-subheading">VERIFIKASI DOKUMEN IZIN</div>

                    <hr>
                    @if ($track)
                        <div class="alert alert-success"> data ditemukan, silahkan scroll kebawah</div>
                    @else
                        <div class="alert alert-danger"> data tidak ditemukan</div>
                    @endif
                </div>

            </div>


        </div>


        </div>
    </header>
    @if ($track)
        <!-- Services-->
        <section class="page-section bg-light" id="perizinan">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">

                        <div class="">

                            <div class="container2">
                                <article class="card">
                                    <header class="card-header"> {{ $track->service->name }} <br>
                                        @if ($track->file_permit)
                                            Status Dokumen : <span class="label label-success">Sudah ditandangani
                                                digital</span>
                                        @else
                                            Status Dokumen : <span class="label label-danger">Belum ditandangani
                                                digital</span>
                                        @endif
                                    </header>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <tr>
                                                <th colspan="3"> Data Pemohon</th>
                                            </tr>
                                            <tr>
                                                <td>Nama Pemohon</td>
                                                <td>:</td>
                                                <td>{{ $track->applicant_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Induk KTP</td>
                                                <td>:</td>
                                                <td>{{ $track->nik }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Induk Kartu Keluarga</td>
                                                <td>:</td>
                                                <td>{{ $track->no_kk }}</td>
                                            </tr>
                                            <tr>
                                                <td>NPWP</td>
                                                <td>:</td>
                                                <td>{{ $track->npwp }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>:</td>
                                                <td>{{ $track->gender }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tempat/Tanggal Lahir</td>
                                                <td>:</td>
                                                <td>{{ $track->place_of_birth }} / {{ $track->date_of_birth }}</td>
                                            </tr>
                                            <tr>
                                                <td>Telepon/HP</td>
                                                <td>:</td>
                                                <td>{{ $track->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat KTP</td>
                                                <td>:</td>
                                                <td>{{ $track->address_ktp }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </article>


                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif


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
