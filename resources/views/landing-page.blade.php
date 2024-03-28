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
        
         .spinner {
            display: none;
        }

        .displaynone {
            display: none;
        }
    </style>

</head>

<body id="page-top">
    <!-- Navigation-->
    @include('layouts.landing-page.navbar')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    
                    <div class="masthead-subheading">Selamat datang, di Perizinan Online DPMPTSP
                        Kabupaten Bulukumba</div>
                    <div class="masthead-heading">Sistem perizinan online DPMPTSP ini diperuntukkan bagi pemohon yang
                        akan mengajukan permohonan perizinan secara online menggunakan sertifikat elektronik yang 
                        diterbitkan oleh Balai Sertifikasi Elektronik (BSrE), BSSN
                        
                        <img src="assets/img/bssn_2.png" alt="..." width="200"/>
                    </div>
                </div>

                <div class="col-md-5 bg-light" style="padding-bottom: 40px;">
                    <img class="img-fluid" src="assets/img/logo-header.png" alt="..." />
                </div>
            </div>


        </div>
    </header>
    <!-- Services-->
    <section class="page-section bg-light" id="perizinan">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <h6 class="section-heading text-uppercase">Perizinan Populer</h6>

                        {{-- <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/shop-2.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="2"
                                                class="layanan-info">
                                                <h5 class="card-title">SIUP</h5>
                                                <p class="card-text"><small class="text-muted">Surat Izin Usaha
                                                        Perdagangan</small></p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/pin.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="1"
                                                class="layanan-info">
                                                <h5 class="card-title">SITU</h5>
                                                <p class="card-text"><small class="text-muted">Surat Izin
                                                        Tempat Usaha</small></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/building.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="3"
                                                class="layanan-info">
                                                <h5 class="card-title">TDP</h5>
                                                <p class="card-text"><small class="text-muted">Tanda Daftar
                                                        Perusahaan</small></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/doctor.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">

                                            <a data-bs-toggle="modal" href="#empModal" data-id="9"
                                                class="layanan-info">
                                                <h5 class="card-title">SIPP</h5>
                                                <p class="card-text"><small class="text-muted">Surat Izin
                                                        Praktek Perawat
                                                    </small></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/building.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="16"
                                                class="layanan-info">
                                                <h5 class="card-title">IMB</h5>
                                                <p class="card-text"><small class="text-muted">Izin Mendirikan
                                                        Bangunan</small></p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/user.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="4"
                                                class="layanan-info">
                                                <h5 class="card-title">PENELITIAN</h5>
                                                <p class="card-text"><small class="text-muted">Surat Izin
                                                        Penelitian
                                                    </small></p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/car.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="25"
                                                class="layanan-info">
                                                <h5 class="card-title">Izin Trayek</h5>
                                                <p class="card-text"><small class="text-muted">Surat Izin
                                                        Trayek
                                                    </small></p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/user.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="44"
                                                class="layanan-info">
                                                <h5 class="card-title">KARTU AK/1</h5>
                                                <p class="card-text"><small class="text-muted">KARTU TANDA PENDAFTARAN PENCARI KERJA (AK/1)
                                                    </small></p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 text-center">
                                        <img src="assets/landing-page/img/icons/building.svg" width="50" height="50"
                                            alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" href="#empModal" data-id="46"
                                                class="layanan-info">
                                                <h5 class="card-title">SERTIFIKAT SLHS</h5>
                                                <p class="card-text"><small class="text-muted">	SERTIFIKAT LAIK HIGIENE SANITASI (SLHS)
                                                    </small></p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h6 class="section-heading text-uppercase">Perizinan Lainnya</h6>
                    <div class="form-group">

                        <div class="col-sm-12">
                            <input type="text" class="form-control form-search" placeholder="cari perizinan">
                        </div>
                        <hr>
                    </div>
                    <div class="box">
                        <ul class="list-group list-search">
                            @foreach ($services as $service)
                                <li class="list-group-item "><a data-bs-toggle="modal" href="#empModal"
                                        class="item-list layanan-info"
                                        data-id="{{ $service->id }}">{{ $service->name }}</a></li>
                            @endforeach


                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- About-->
    <section class="page-section" id="informasi">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Alur Perizinan Online</h2>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets/landing-page/img/about/a1.png" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>Langkah 1</h4>
                            <h4 class="subheading">Pendaftaran Akun</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Cukup siapkan email aktif, nomor HP, KTP dan Koneksi internet lalu isi formulir registrasi yang tersedia</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets/landing-page/img/about/a2.png" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>Langkah 2</h4>
                            <h4 class="subheading">Verifikasi Email </h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Silahkan buka email yang kamu gunakan saat mendaftarkan akun,
                                kemudian
                                klik tombol aktivasi akun pada email yang dikirimkan sistem
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets/landing-page/img/about/a3.png" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>Langkah 3</h4>
                            <h4 class="subheading">Login ke sistem</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Silahkan kamu login ke sistem perizinan online menggunakan email
                                dan Password yang kamu masukan pada saat registrasi</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets/landing-page/img/about/a4.png" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>Langkah 4</h4>
                            <h4 class="subheading">Aktifitas Perizinan</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Silahkan memilih layanan perizinan yang tersedia. Operator kami
                                akan segera menindak lanjuti permohonan kamu.</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>
                            <br>
                            Selesai, mudahkan

                        </h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>


   
    <!-- Footer-->
    <!-- Portfolio item 1 modal popup-->
    <div class="portfolio-modal modal fade" id="empModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img
                        src="{{ asset('assets/landing-page/img/close-icon.svg') }}" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i> Loading... </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.landing-page.footer')

    @include('layouts.landing-page.javascript')
</body>

</html>
