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
                <form class="form-prevent" action="{{ route('izin.edar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pemegang_izin_id" value="{{ $data->id }}">
                    <div class="row gx-3">
                        <h4>PENERIMA: </h4>
                        <hr>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="no_permohonan_angkut">Nomor Permohonan Angkut <span class="text-red">(Wajib*)</span></label>
                            <input class="form-control" id="no_permohonan_angkut" name="no_permohonan_angkut" type="text" value="{{ old('no_permohonan_angkut') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="tgl_permohonan_angkut">Tanggal Permohonan Angkut <span class="text-red">(Wajib*)</span></label>
                            <input class="form-control" id="tgl_permohonan_angkut" name="tgl_permohonan_angkut" type="date" value="{{ old('tgl_permohonan_angkut') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="no_satdn_asal">Nomor SATS-DN Asal <span class="text-info">(opsional*)</span></label>
                            <input class="form-control" id="no_satdn_asal" name="no_satdn_asal" type="text" value="{{ old('no_satdn_asal') }}"">
                        </div>
                        <div class=" mb-3 col-md-6">
                            <label class="small mb-1" for="tgl_satdn_asal">Tanggal SATS-DN Asal <span class="text-info">(opsional*)</span></label>
                            <input class="form-control" id="tgl_satdn_asal" name="tgl_satdn_asal" type="date" value="{{ old('tgl_satdn_asal') }}">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="small mb-1" for="nama_penerima">Nama / Nama Perusahaan / Nama Lembaga </label>
                            <input class="form-control" id="nama_penerima" name="nama_penerima" type="text" placeholder="" value="{{ old('nama_penerima') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="telepon_penerima">Telepon <span class="text-red">(Wajib*)</span></label>
                            <input class="form-control" id="telepon_penerima" name="telepon_penerima" type="text" placeholder="" value="{{ old('telepon_penerima') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="fax_penerima">FAX <span class="text-info">(opsional*)</span></label>
                            <input class="form-control" id="fax_penerima" name="fax_penerima" type="text" placeholder="" value="{{ old('fax_penerima') }}">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="small mb-1" for="alamat_lengkap_penerima">Alamat Lengkap <span class="text-red">(Wajib*)</span></label>
                            <input class="form-control" id="alamat_lengkap_penerima" name="alamat_lengkap_penerima" type="text" placeholder="" value="{{ old('alamat_lengkap_penerima') }}" required>
                        </div>
                    </div>
                    <div class="row gx-3">
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="alat_angkut">Alat Angkut <span class="text-red">(Wajib*)</span></label>
                            <select name="alat_angkut" id="alat_angkut" class="form-control" value="{{ old('alat_angkut') }}" required>
                                <option value="">Pilih Alat Angkut</option>
                                <option value="Darat"> Darat</option>
                                <option value="Darat"> Laut</option>
                                <option value="Darat"> Udara</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="dari">Dari <span class="text-red">(Wajib*)</span></label>
                            <input class="form-control" id="dari" name="dari" type="text" placeholder="Contoh Makassar" value="{{ old('dari') }}" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="small mb-1" for="ke">Ke <span class="text-red">(Wajib*)</span></label>
                            <input class="form-control" id="ke" name="ke" type="text" placeholder="Contoh Bali" value="{{ old('ke') }}" required>
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
                            <input class="form-control" id="jumlah_kirim" name="jumlah_kirim" type="number" value="{{ old('jumlah_kirim') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="jumlah_kirim">Lokasi Penerbitan SATS-DN</label>
                            <select name="admin_teknis" id="admin_teknis" class="form-control" value="{{ old('admin_teknis') }}">
                                @foreach ($admin_teknis as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="file_permohonan">Dokumen Permohonan <span class="text-red">(pdf/max: 2mb)</span></label>
                            <br>
                            <input type="file" class="form-control" name="file_permohonan" required>

                        </div>


                    </div>

                    <div class="row gx-3">
                        <h4><br> DAFTAR TSL: </h4>
                        <hr>
                        <div class="mb-3 table-responsive" id="dynamic-form">
                            <table class="table" id="tsl-table">
                                <tr>
                                    <th>Nama Indonesia</th>
                                    <th>Nama Latin</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Ket</th>
                                    <th>#</th>
                                </tr>
                                @foreach ($data->pemegangIzinTsl as $tsl)
                                <tr class="tsl-row">
                                    <td><input type="text" class="form-control" name="nama_indonesia[]" placeholder="Nama Indonesia" value="{{ $tsl->nama_indonesia }}" readonly></td>
                                    <td><input type="text" class="form-control" name="nama_latin[]" placeholder="Nama Latin" value="{{ $tsl->nama_latin }}" readonly></td>
                                    <td><input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah"></td>
                                    <td><input type="text" class="form-control" name="satuan[]" placeholder="Satuan" value="{{ $tsl->satuan }}" readonly></td>
                                    <td><input type="text" class="form-control" name="keterangan[]" placeholder="keterangan"></td>
                                    <td><a href="#" class="text-red delete-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                <tr class="tsl-row">
                                    <td><input type="text" class="form-control" name="nama_indonesia[]" placeholder="Nama Indonesia"></td>
                                    <td><input type="text" class="form-control" name="nama_latin[]" placeholder="Nama Latin"></td>
                                    <td><input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah"></td>
                                    <td><input type="text" class="form-control" name="satuan[]" placeholder="Satuan"></td>
                                    <td><input type="text" class="form-control" name="keterangan[]" placeholder="keterangan"></td>
                                    <td><a href="#" class="text-red delete-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            </table>
                            <button type="button" id="add-field" class="btn btn-warning btn-sm float-end"><i class="fa fa-plus"></i> Add</button>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">

                                <button class="btn btn-primary button-prevent" type="submit">
                                    <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i> Loading...
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
@push('js')

<script>
    $(document).ready(function() {
        // Event handler untuk tombol hapus
        $(document).on('click', '.delete-row', function(e) {
            e.preventDefault(); // Mencegah aksi default dari link

            // Menghapus elemen tr yang berada di dalam parentnya (tbody)
            $(this).closest('tr').remove();
        });

        $('#add-field').click(function() {
            var lastFormGroup = $('#dynamic-form').find('.tsl-row:last');

            var newFormGroup = lastFormGroup.clone();
            newFormGroup.find('input').val(''); // Kosongkan nilai input
            lastFormGroup.after(newFormGroup); // Tambahkan setelah form-group terakhir
        });

        $('#dynamic-form').submit(function() {
            // Loop melalui setiap baris pada tabel
            $('#tsl-table tbody tr').each(function() {
                var inputsWithValue = $(this).find('input').filter(function() {
                    return $(this).val() !== ''; // Filter input yang memiliki nilai
                });

                // Jika ada setidaknya satu input dengan nilai, biarkan barisnya dikirim
                if (inputsWithValue.length > 0) {
                    return true;
                } else {
                    // Jika tidak ada input dengan nilai, hapus baris dari DOM
                    $(this).remove();
                }
            });
        });
    });
</script>

@endpush
