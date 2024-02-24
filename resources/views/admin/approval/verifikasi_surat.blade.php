<section>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title">Rekomendasi Teknis</h3>
                        <a class="btn btn-dropbox btn-sm"
                                                href="{{ url('view-file?download_file=' . $data->doc_verified_teknis) }}"
                                                target="_blank" rel="noopener noreferrer"> <i
                                                    class="fa fa-download"></i> </a>
                    </div>

                    <div class="box-body">
                        <embed type="application/pdf" src="{{ url('view-file?download_file=' . $data->doc_verified_teknis) }}"
                            width="100%" height="900"></embed>
                        

                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title">Preview Format Surat Izin</h3>
                    </div>

                    <div class="box-body">

                        <embed type="application/pdf"
                            src="https://docs.google.com/gview?url={{ url('/') }}/{{ $data->temp_file_permit }}&embedded=true"
                            width="100%" height="900"></embed>

                    </div>
                </div>
                @if ($data->ProgresApproval)
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <i class="fa fa-warning"></i>
                            <h3 class="box-title">Catatan revisi dari pimpinan</h3>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <th>Ka. Seksi</th>
                                    <td>{{ $data->ProgresApproval->note_ka_seksi }}</td>
                                </tr>
                                <tr>
                                    <th>Ka. Bidang</th>
                                    <td>{{ $data->ProgresApproval->note_ka_bidang }}</td>
                                </tr>
                                <tr>
                                    <th>Sekretaris</th>
                                    <td>{{ $data->ProgresApproval->note_sekretaris }}</td>
                                </tr>
                                <tr>
                                    <th>Ka. Dinas</th>
                                    <td>{{ $data->ProgresApproval->note_ka_dinas }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
            <div class="col-md-6">
                <div class="box box-default">

                    <div class="box-body">



                        <table class="table table-striped">
                            <tr>
                                <th colspan="3"> Data Pemohon</th>
                            </tr>
                            <tr>
                                <td>Nama Pemohon</td>
                                <td>:</td>
                                <td>{{ $data->applicant_name }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Induk KTP</td>
                                <td>:</td>
                                <td>{{ $data->nik }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Induk Kartu Keluarga</td>
                                <td>:</td>
                                <td>{{ $data->no_kk }}</td>
                            </tr>
                            <tr>
                                <td>NPWP</td>
                                <td>:</td>
                                <td>{{ $data->npwp }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $data->gender }}</td>
                            </tr>
                            <tr>
                                <td>Tempat/Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $data->place_of_birth }} / {{ $data->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <td>Telepon/HP</td>
                                <td>:</td>
                                <td>{{ $data->phone_number }}</td>
                            </tr>
                            <tr>
                                <td>Alamat KTP</td>
                                <td>:</td>
                                <td>{{ $data->address_ktp }}</td>
                            </tr>

                        </table>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="3">Formulir Isian Pemohon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->inputs as $doc)
                                    <tr>

                                        <td>{!! $doc->input_name !!}</td>
                                        <td>:</td>
                                        <td> {{ $doc->value }}
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <thead>
                                <tr>

                                    <th colspan="3">Dokumen Persyaratan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->documents as $doc)
                                    <tr>

                                        <td>{!! $doc->document_name !!},</td>
                                        <td>:</td>
                                        <td>
                                            <a class="btn btn-dropbox btn-sm"
                                                href="{{ url('view-file?download_file=' . $doc->file_document) }}"
                                                target="_blank" rel="noopener noreferrer"> <i
                                                    class="fa fa-eye"></i> </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="alert alert-danger alert-dismissible">
                            <h4><i class="icon fa fa-ban"></i> Perhatian</h4>
                            <p>Preosedur membuat format surat</p>
                            <ol>
                                <li>Download terlebih dahulu file ms.word surat hasil generate aplikasi</li>
                                <li>Lakukan pengeditan pada file tersebut untuk nomor surat apabila ada perubahan format
                                    atau nomor tidak sesuai dengan nomor buku surat keluar izin </li>
                                <li>Lakukan pengeditan untuk menyesuaikan format surat terbaru atau yang berlaku </li>
                                <li>Simpan kembali file dalam bentuk PDF lalu upload untuk disetujui oleh pimpinan</li>
                            </ol>
                        </div>
                        <!-- form start -->
                        <form action="{{ url('admin-panel/kirim_surat') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <ul class="timeline">

                                <!-- timeline item -->
                                <li>
                                    <!-- timeline icon -->
                                    <i class="fa fa-download bg-blue"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">Generate File</a></h3>

                                        <div class="timeline-body">
                                            Download terlebih dahulu file ms.word surat hasil generate aplikasi
                                        </div>

                                        <div class="timeline-footer">
                                            <a target="_blank" href="/{{ $data->temp_file_permit }}"
                                                class="btn btn-primary btn-sm">
                                                Download surat</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- timeline icon -->
                                    <i class="fa fa-upload bg-blue"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">Upload File Surat</a></h3>

                                        <div class="timeline-body">
                                            Upload format surat dalam bentuk PDF untuk disetujui oleh pimpinan
                                        </div>

                                        <div class="timeline-footer">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label>Nomor Surat</label>
                                                @php
                                                    $format = $data->service->format_number;
                                                    $last_number = App\Models\ProgresDocument::where('format_number', $format)
                                                        ->where('approval', 5)
                                                        ->count();
                                                    $lastId = App\Models\ProgresDocument::max('id');
                                                    $invoice = sprintf('%03s', abs($last_number + 1));
                                                    $array_bln = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                                    $bln = $array_bln[date('n')];
                                                @endphp
                                                <input type="text" class="form-control" name="number_letter"
                                                    value="{{ $invoice }}/{{ $format }}/{{ $bln }}/{{ date('Y') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Estimasi surat terbit</label>
                                                @php
                                                    $tgl1 = date('Y-m-d'); // pendefinisian tanggal awal
                                                    $tgl2 = date('Y-m-d', strtotime('+3 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 3 hari
                                                @endphp
                                                <input type="date" class="form-control" name="date_letter"
                                                    value="{{ $tgl2 }}">
                                            </div>
                                            <div class="form-group">
                                                <label>PDF FIle Surat</label>
                                                <input type="file" class="form-control" name="temp_file_permit">
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-success pull-right ">Submit <i
                                                        class="fa fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                            </ul>

                        </form>


                    </div>
                    <!-- /.box-body -->



                </div>
            </div>
        </div>
    </div>

    </div>
</section>
