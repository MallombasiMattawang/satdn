<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Rincian Pemegang Izin Edar</h3>
                <div class="box-tools pull-right">
                    <a href="{{ url('/datapol-panel/tim-relawan/pdf/' . $data->id) }}" class="btn btn-primary btn-sm"
                        target="_blank"><i class="fa fa-print"></i> Cetak</a>
                    @if (Admin::user()->isAdministrator())
                        <a href="#" class="modal-delete-tim btn btn-danger btn-sm"
                            data-id="{{ $data->id }}"><i class="fa fa-trash"></i></a>
                    @endif
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">

                    <tr>
                        <td>Pengirim (Nama/Perusahaan/Lembaga)</td>
                        <th>{{ $data->pemegangIzin->nama_perusahaan }}
                            {!! $data->pemegangIzin->active == 'Y'
                                ? '<p class="text-green"> [ ACTIVE ]</p>'
                                : '<p class="text-redd"> [ NON ACTIVE ]</p>' !!}

                        </th>
                    </tr>
                    <tr>
                        <td>No. Ijin mengambil/menangkap TSL</td>
                        <th>{{ $data->pemegangIzin->no_sk_oss }} </th>
                    </tr>
                    <tr>
                        <td>Tanggal Berlaku Ijin</td>
                        <th>{{ tgl_indo($data->pemegangIzin->tgl_sk_oss) }} </th>
                    </tr>
                    <tr>
                        <td>Tanggal Habis Ijin</td>
                        <th>{{ tgl_indo($data->pemegangIzin->tgl_habis_sk) }} </th>
                    </tr>
                    <tr>
                        <td>Jenis TSL / Satuan</td>
                        <th>{{ $data->pemegangIzin->jenis_tsl }} / {{ $data->pemegangIzin->satuan }}</th>
                    </tr>
                    <tr>
                        <td>Kuota</td>
                        <th>{{ $data->pemegangIzin->kuota }} / {{ $data->pemegangIzin->satuan }}</th>
                    </tr>
                    <tr>
                        <td>Kuota Digunakan</td>
                        <th>{{ $data->pemegangIzin->kuota_digunakan }} / {{ $data->pemegangIzin->satuan }}</th>
                    </tr>
                    <tr>
                        <td>Kuota Sisa</td>
                        <th>{{ $data->pemegangIzin->kuota_sisa }} / {{ $data->pemegangIzin->satuan }}</th>
                    </tr>

                    <tr class="bg-info">
                        <td>Total Pengiriman</td>
                        <th>{{ $data->pemegangIzin->count() }}X Kirim</th>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</div>
