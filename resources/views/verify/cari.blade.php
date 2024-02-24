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
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
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
                    <div class="masthead-subheading">LACAK PERMOHONAN IZIN</div>
                    <div class="masthead-heading">Sistem Tracking perizinan online DPMPTSP ini diperuntukkan bagi pemohon
                        yang
                        akan mengajukan permohonan perizinan secara online, silahkan masukan nomor registrasi
                        pendaftaran.</div>
                    <p>Cari Data Izin :</p>
                    <form action="{{ route('tracking.cari') }} " method="GET" class="form-prevent">
                        @csrf
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" name="cari" class="form-control" placeholder="nomor registrasi..."
                                    required value="{{ old('cari') }}">
                                <br>
                                <button type="submit" class="btn btn-danger btn-lg button-prevent">
                                    <div class="spinner"><i role="status"
                                            class="spinner-border spinner-border-sm"></i> Proses tracking... </div>
                                    <div class="hide-text">Cari</div>
                                </button>
                                <hr>
                                @if ($track)
                                    <div class="alert alert-success"> data ditemukan, silahkan scroll kebawah</div>
                                @else
                                    <div class="alert alert-danger"> data tidak ditemukan</div>
                                @endif
                            </div>
                        </div>
                    </form>
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
                                    <header class="card-header"> Tracking Izin </header>
                                    <div class="card-body">
                                        <h6>No.Reg: {{ $track->no_invoice }}</h6>
                                        <article class="card">
                                            <div class="card-body row">
                                                <div class="col"> <strong>Estimasi Selesai :</strong>

                                                    <br>@php
                                                        $tgl1 = $track->date_start_progres; // pendefinisian tanggal awal
                                                        $tgl2 = date('Y-m-d', strtotime('+6 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
                                                        echo $tgl2;
                                                    @endphp
                                                </div>
                                                <div class="col"> <strong>Pemohon:</strong> <br>
                                                    {{ $track->applicant_name }} </div>
                                                <div class="col"> <strong>Status:</strong> <br>
                                                    @if ($track->date_end_progres)
                                                        Selesai
                                                    @else
                                                        Proses
                                                    @endif
                                                </div>
                                                <div class="col"> <strong>Jenis Izin #:</strong> <br>
                                                    {{ $track->service->name }} </div>
                                            </div>
                                        </article>

                                        <div class="track">
                                            <div class="step <?php echo $track->date_verified_doc ? 'active' : ''; ?>">
                                                <span class="icon"> <i class="fa fa-check"></i> </span>
                                                <span class="text">Verifikasi Dokumen <br> </span>
                                            </div>
                                            <div class="step <?php echo $track->date_verified_teknis ? 'active' : ''; ?>"> <span class="icon"> <i
                                                        class="fa fa-users"></i> </span> <span
                                                    class="text"> Verifikasi Teknis</span> </div>
                                            <div class="step <?php echo $track->approval ? 'active' : ''; ?>" style="width: 400"> <span
                                                    class="icon"> <i class="fa fa-user"></i> </span> <span
                                                    class="text"> Approval Pimpinan </span> </div>
                                            <div class="step <?php echo $track->date_end_progres ? 'active' : ''; ?>"> <span class="icon"> <i
                                                        class="fa fa-box"></i> </span> <span
                                                    class="text">Izin Terbit</span> </div>
                                        </div>
                                        <br>

                                    </div>
                                </article>
                                <article class="card">
                                    <div class="alert alert-warning">
                                        {{ $track->dateDoc() }} : <br>
                                        {{ \Mstring::strip_only_tags($track->note_verified_doc, '<p><img>') }}
                                        
                                    </div>

                                    <div class="alert alert-info">
                                        {{ $track->dateTeknis() }} : <br> 
                                        {{ \Mstring::strip_only_tags($track->note_verified_teknis, '<p><img>') }}
                                    </div>

                                    @if ($track->approval)
                                        <div class="alert alert-info">
                                            {{ $track->dateTeknis() }} :
                                            Proses Aproval Pimpinan
                                        </div>
                                    @endif

                                    @if ($track->date_end_progres)
                                        <div class="alert alert-success">
                                            {{ $track->dateEnd() }} :
                                            Izin Telah diterbitkan
                                        </div>
                                    @endif
                                </article>
                                <article class="card">
                                    @if ($track->date_end_progres)

                                        <hr> <a href="{{ url('view-file/sk_pdf?number=' . $track->no_invoice) }}"
                                            class="btn btn-warning" data-abc="true" target="_blank"> <i
                                                class="fa fa-print"></i> Cetak Surat Keterangan Izin</a>
                                        <hr>
                                        <br>
                                        <embed type="application/pdf"
                                            src="{{ url('view-file/sk_pdf?number=' . $track->no_invoice) }}"
                                            width="100%" height="800"></embed>

                                    @endif
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
