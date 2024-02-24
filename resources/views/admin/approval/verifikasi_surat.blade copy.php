<section>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title">Preview Surat Izin</h3>
                    </div>

                    <div class="box-body">
                        jika tidak tampil di preview, silahkan download surat-nya
                        <a target="_blank" href="/{{ $data->temp_file_permit }}" class="btn btn-danger btn-sm">
                            download surat</a>
                        <hr>
                        <embed type="application/pdf"
                            src="https://docs.google.com/gview?url={{ url('/') }}/{{ $data->temp_file_permit }}&embedded=true"
                            width="100%" height="900"></embed>

                    </div>
                </div>
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
                                <li>Lakukan pengeditan pada file tersebut untuk nomor surat apabila ada perubahan format atau nomor tidak sesuai dengan nomor buku surat keluar izin </li>
                                <li>Lakukan pengeditan untuk menyesuaikan format surat terbaru atau yang berlaku </li>
                                <li>Simpan kembali file dalam bentuk PDF lalu upload untuk disetujui oleh pimpinan</li>
                            </ol>
                        </div>
                        <!-- form start -->
                        <form action="/api/signPdf" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>FIle</label>
                                <input type="file" class="form-control" name="signed_file">
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right ">Setujui & Lanjut <i
                                        class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </form>


                    </div>
                    <!-- /.box-body -->



                </div>
            </div>
        </div>
    </div>

    </div>
</section>
