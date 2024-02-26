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
                <div class="row gx-3">
                    <h4>PENGIRIM: </h4>
                    <hr>
                    <div class="mb-3 col-md-6">
                        <label class="small mb-1" for="nama_pengirim">Nama / Nama Perusahaan / Nama Lembaga </label>
                        <input class="form-control" id="nama_pengirim" name="nama_pengirim" type="text" placeholder="" value="{{ $data->nama_perusahaan }}" readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="small mb-1" for="no_sk_oss">Ijin Mengambil/menangkatp TSL</label>
                        <input class="form-control" id="no_sk_oss" name="no_sk_oss" type="text" placeholder="" value="{{ $data->no_sk_oss }}" readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="small mb-1" for="telepon">Telepon</label>
                        <input class="form-control" id="telepon" name="telepon" type="text" placeholder="" value="{{ $data->telepon }}" readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="small mb-1" for="fax">FAX</label>
                        <input class="form-control" id="fax" name="fax" type="text" placeholder="" value="{{ $data->fax }}" readonly>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="small mb-1" for="alamat_lengkap">Alamat Lengkap</label>
                        <input class="form-control" id="alamat_lengkap" name="alamat_lengkap" type="text" placeholder="" value="{{ $data->alamat_lengkap }}" readonly>
                    </div>

                </div>
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
                        <div class="mb-3 col-md-12">
                            <label class="small mb-1" for="nama_penerima">Nama / Nama Perusahaan / Nama Lembaga </label>
                            <input class="form-control" id="nama_penerima" name="nama_penerima" type="text" placeholder="" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="telepon_penerima">Telepon</label>
                            <input class="form-control" id="telepon_penerima" name="telepon_penerima" type="text" placeholder="" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="fax_penerima">FAX</label>
                            <input class="form-control" id="fax_penerima" name="fax_penerima" type="text" placeholder="" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="small mb-1" for="alamat_lengkap_penerima">Alamat Lengkap</label>
                            <input class="form-control" id="alamat_lengkap_penerima" name="alamat_lengkap_penerima" type="text" placeholder="" required>
                        </div>
                    </div>
                    <div class="row gx-3">

                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="alat_angkut">Alat Angkut</label>
                            <select name="alat_angkut" id="alat_angkut" class="form-control" required>
                                <option value="">Pilih Alat Angkut</option>
                                <option value="Darat"> Darat</option>
                                <option value="Darat"> Laut</option>
                                <option value="Darat"> Udara</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="dari">Dari</label>
                            <input class="form-control" id="dari" name="dari" type="text" placeholder="Contoh Makassar" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="ke">Ke</label>
                            <input class="form-control" id="ke" name="ke" type="text" placeholder="Contoh Bali" required>
                        </div>
                        <hr>
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="jenis_tsl">Jenis Tumbuhan / Satwa Liar</label>
                            <input class="form-control" id="jenis_tsl" name="jenis_tsl" type="text" value="{{ $data->jenis_tsl }}" readonly>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="satuan">Satuan</label>
                            <input class="form-control" id="satuan" name="satuan" type="text" value="{{ $data->satuan }}" readonly>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="jumlah_kirim">Jumlah (Sisa Kuota {{ $data->kuota - $data->kuota_digunakan }} {{ $data->satuan }})</label>
                            <input class="form-control" id="jumlah_kirim" name="jumlah_kirim" type="number" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">

                                <button class="btn btn-primary button-prevent" type="submit">
                                    <div class="spinner"><i role="status"
                                            class="spinner-border spinner-border-sm"></i> Loading...
                                    </div>
                                    <div class="hide-text">Submit</div>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
