<section class="invoice">
    {!! Session::has('msg') ? Session::get('msg') : '' !!}
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">

                <img src="{{ url('/') }}/assets/img/bssn_2.png" alt="..." width="200" />

                <small class="pull-right">Tanggal:
                    @if ($data->date_verified_teknis)
                        {{ $data->dateTeknis() }}
                    @else
                        {{ $data->dateDoc() }}
                    @endif
                </small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Dari
            <address>
                <strong>
                    {{ $from }} <br>

                </strong><br>


            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Kepada
            <address>
                <strong>{{ $to }}</strong><br>
                Bagian {{ $data->service->name }}<br>

            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>No.Reg: {{ $data->no_invoice }}</b><br>
            <b>Jenis Izin:</b> {{ $data->service->name }}<br>
            @if ($data->number_letter)
                <b>Nomor Surat:</b> {{ $data->number_letter }}<br>
            @endif


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.data pemohon -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
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
        </div>
    </div>
    <hr>
    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>Formulir Layanan</th>
                        <th>Value</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->inputs as $doc)
                        <tr>

                            <td>{!! $doc->input_name !!}</td>
                            <td><label class="label label-success"> {{ $doc->value }}</label> </td>
                            <td><label class="label label-success"> <i class="fa fa-check"></i> OK</label> </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>Dokumen Persyaratan</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->documents as $doc)
                        <tr>

                            <td>{!! $doc->document_name !!},</td>
                            <td><label class="label label-success"> <i class="fa fa-check"></i> OK</label> </td>
                            <td>
                                <a class="btn btn-dropbox"
                                    href="{{ url('view-file?download_file=' . $doc->file_document) }}"
                                    target="_blank" rel="noopener noreferrer"> <i class="fa fa-eye"></i> </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            @if ($data->date_verified_teknis)
                <p class="lead"> Verifikator Teknis <br> </p>
            @else
                <p class="lead">Verifikator Dokumen <br> </p>
            @endif

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                @if ($data->date_verified_teknis)
                    {{ $data->note_verified_teknis }} <br>
                    - Verifikator :
                    ( {{ $data->verifikator_teknis }} )
                @else
                    {{ $data->note_verified_doc }}
                    <br>
                    - Verifikator :
                    ( {{ $data->verifikator }} )
                @endif
            </p>

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">Setujui Permohonan</p>
            <div class="box box-primary">

                <!-- form start -->
                <form action="{{ url('admin-panel/setApproval_1') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="progres_document_id" value="{{ $data->id }}">
                    <input type="hidden" name="idTo" value="{{ $idTo }}">
                    <input type="hidden" name="to" value="{{ $to }}">
                    <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                    <input type="hidden" name="no_invoice" value="{{ $data->no_invoice }}">

                    <div class="box-body">
                        <div class="form-group">
                            <label>NAMA PIMPINAN</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                        </div>
                        @if ($to == 'SEKRETARIS')
                            <div class="form-group">
                                <label>NOMOR IZIN</label>
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
                        @endif
                        @if ($to == 'KEPALA DINAS')
                            <div class="form-group">
                                <label>NOMOR SURAT</label>
                                <input type="text" class="form-control" value="{{ $data->number_letter }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label>PASSPHRASE
                                    <br>
                                    (Masukan PASSPHRASE akun anda untuk menandatangi dokumen ini secara elektronik)
                                </label>
                                <input type="text" class="form-control" name="passphrase" id="passphrase" value="{{ $data->passphrase }}"
                                >
                               
                            </div>
                        @endif

                        <div class="form-group">
                            <label>CATATAN {{ $to }}</label>
                            <textarea name="note_pimpinan" class="form-control" id="" cols="10" rows="5"
                                required></textarea>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="approve" required> SETUJUI
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right ">Setujui & Lanjut <i
                                class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="{{ url('view-file/sk_pdf?number=' . $data->no_invoice) }}" target="_blank"
                class="btn btn-default"><i class="fa fa-print"></i>
                Print Proses Berjalann</a>
                <a class="btn btn-danger" target="_blank" href="/print?id={{ $data->id }}">  <i class="fa fa-print"></i> Lihat Format Surat & Setujui</a>
                

            @if ($data->file_permit)
                <a href="{{ url('view-file?download_file=' . $data->file_permit) }}" target="_blank"
                    class="btn btn-default"><i class="fa fa-print"></i>
                    Print Blanko SK</a>
            @endif

            <hr>
            @if ($data->file_permit)
                <embed type="application/pdf" src="{{ url('view-file?download_file=' . $data->file_permit) }}"
                    width="100%" height="800"></embed>
            @endif

                    <h4>Preview Format Surat Izin</h4> 
            {{-- <embed type="application/pdf" src="{{ url('convert?id=' . $data->id) }}"
                width="100%" height="800"></embed> --}}
                <embed type="application/pdf" src="https://docs.google.com/gview?url=http://www.picssel.com/demos/downloads/Fancybox.doc&embedded=true"
                    width="100%" height="800"></embed>
                    

        </div>
    </div>
</section>
