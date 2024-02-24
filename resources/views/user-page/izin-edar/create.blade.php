@extends('layouts.user-page.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Buat Permohonan SATS-DN
                        </h1>

                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-body px-0">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-prevent" action="{{ route('store-service') }}" method="POST">
                        @csrf

                        <div class="row gx-3">
                            <h4>PENGIRIM: </h4>
                            <hr>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="nama_pengirim">Nama / Nama Perusahaan / Nama Lembaga </label>
                                <input class="form-control" id="nama_pengirim" name="nama_pengirim"
                                    type="text" placeholder="" value="{{ $data->nama_perusahaan }}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="no_sk_oss">Ijin Mengambil/menangkatp TSL</label>
                                <input class="form-control" id="no_sk_oss" name="no_sk_oss"
                                    type="text" placeholder="" value="{{ $data->no_sk_oss }}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="telepon">Telepon</label>
                                <input class="form-control" id="telepon" name="telepon" type="text"
                                    placeholder="" value="{{ $data->telepon }}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="fax">FAX</label>
                                <input class="form-control" id="fax" name="fax" type="text"
                                    placeholder="" value="{{ $data->fax }}" readonly>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="small mb-1" for="alamat_lengkap">Alamat Lengkap</label>
                                <input class="form-control" id="alamat_lengkap" name="alamat_lengkap" type="text"
                                    placeholder="" value="{{ $data->alamat_lengkap }}" readonly>
                            </div>


                        </div>
                        <div class="row gx-3">

                            <div class="mb-3 col-md-4">
                                <label class="small mb-1" for="kuota">Kuota</label>
                                <input class="form-control" id="kuota" name="kuota" type="text"
                                    placeholder="" value="{{ $data->kuota }}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="small mb-1" for="kuota_digunakan">Kuota Digunakan</label>
                                <input class="form-control" id="kuota_digunakan" name="kuota_digunakan" type="text"
                                    placeholder="" value="{{ $data->kuota_digunakan }}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="small mb-1" for="kuota_sisa">Kuota Sisa</label>
                                <input class="form-control" id="kuota_sisa" name="kuota_sisa" type="text"
                                    placeholder="" value="{{ $data->kuota_sisa }}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body px-0">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-prevent" action="{{ route('store-service') }}" method="POST">
                        @csrf

                        <div class="row gx-3">
                            <h4>PENERIMA: </h4>
                            <hr>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="nama_pengirim">Nama / Nama Perusahaan / Nama Lembaga </label>
                                <input class="form-control" id="nama_pengirim" name="nama_pengirim"
                                    type="text" placeholder="" value="{{ $data->nama_perusahaan }}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="no_sk_oss">Ijin Mengambil/menangkatp TSL</label>
                                <input class="form-control" id="no_sk_oss" name="no_sk_oss"
                                    type="text" placeholder="" value="{{ $data->no_sk_oss }}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="telepon">Telepon</label>
                                <input class="form-control" id="telepon" name="telepon" type="text"
                                    placeholder="" value="{{ $data->telepon }}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="fax">FAX</label>
                                <input class="form-control" id="fax" name="fax" type="text"
                                    placeholder="" value="{{ $data->fax }}" readonly>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="small mb-1" for="alamat_lengkap">Alamat Lengkap</label>
                                <input class="form-control" id="alamat_lengkap" name="alamat_lengkap" type="text"
                                    placeholder="" value="{{ $data->alamat_lengkap }}" readonly>
                            </div>


                        </div>
                        <div class="row gx-3">

                            <div class="mb-3 col-md-4">
                                <label class="small mb-1" for="kuota">Kuota</label>
                                <input class="form-control" id="kuota" name="kuota" type="text"
                                    placeholder="" value="{{ $data->kuota }}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="small mb-1" for="kuota_digunakan">Kuota Digunakan</label>
                                <input class="form-control" id="kuota_digunakan" name="kuota_digunakan" type="text"
                                    placeholder="" value="{{ $data->kuota_digunakan }}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="small mb-1" for="kuota_sisa">Kuota Sisa</label>
                                <input class="form-control" id="kuota_sisa" name="kuota_sisa" type="text"
                                    placeholder="" value="{{ $data->kuota_sisa }}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
