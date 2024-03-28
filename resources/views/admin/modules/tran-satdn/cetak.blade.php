<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Rincian Pemegang Izin Edar</h3>

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
                        <th>{{ $data->pemegangIzin->tgl_sk_oss }} </th>
                    </tr>
                    <tr>
                        <td>Tanggal Habis Ijin</td>
                        <th>{{ $data->pemegangIzin->tgl_habis_sk }} </th>
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
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Rincian Pemegang Izin Edar</h3>

            </div>
            <div class="box-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="/admin-panel/tran-satdn/generate" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nomor SATS-DN</td>
                            <th>
                                @if($data->no_satdn)
                                <input type="text" class="form-control" name="no_satdn" value="{{ $data->no_satdn }}">
                                @else
                                <input type="text" class="form-control" name="no_satdn" value="{{ $config->format_surat }}{{ $bulan }}/{{ $tahun }}">
                                @endif

                            </th>
                        </tr>
                        <tr>
                            <td>Dikeluarkan Di</td>
                            <th>
                                <input type="text" class="form-control" name="dikeluarkan_di" value="{{ $data->dikeluarkan_di }}">
                            </th>
                        </tr>
                        <tr>
                            <td>Tgl Berlaku SATS-DN</td>
                            <th>
                                <input type="date" class="form-control" name="tgl_satdn_mulai" value="{{ $data->tgl_satdn_mulai }}">
                            </th>
                        </tr>
                        <tr>
                            <td>Tgl Habis SATS-DN</td>
                            <th>
                                <input type="date" class="form-control" name="tgl_satdn_habis" value="{{ $data->tgl_satdn_habis }}">
                            </th>
                        </tr>
                        <tr>
                            <td>Tgl Dikeluarkan SATS-DN</td>
                            <th>
                                <input type="date" class="form-control" name="tgl_dikeluarkan" value="{{ $data->tgl_dikeluarkan }}">
                            </th>
                        </tr>
                        <tr>
                            <td>Pejabat Penandatangan SATS-DN</td>
                            <th>
                                <input type="text" class="form-control" name="pj_ttd" value="{{ $data->pj_ttd }}" >
                            </th>
                        </tr>
                        <tr>
                            <td>NIP Pejabat Penandatangan SATS-DN</td>
                            <th>
                                <input type="text" class="form-control" name="pj_nip" value="{{ $data->pj_nip }}">
                            </th>
                        </tr>
                        <tr>
                            <td>Jabatan Pejabat Penandatangan SATS-DN</td>
                            <th>
                                <input type="text" class="form-control" name="pj_jabatan" value="{{ $data->pj_jabatan }}">
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-success btn-lg btn-block">GENERATE SATS-DN</button></td>

                        </tr>
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-success btn-lg btn-block">GENERATE SATS-DN DENGAN LAMPIRAN</button></td>

                        </tr>

                    </table>
                </form>

            </div>

        </div>
    </div>

</div>
