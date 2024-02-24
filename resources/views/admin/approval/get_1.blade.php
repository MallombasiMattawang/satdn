<section class="invoice">

    @if (Session::has('msg'))
        <div class="alert alert-warning">
            {!! Session::has('msg') ? Session::get('msg') : '' !!}
        </div>
    @endif
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
                @if ($data->file_permit)
                    Status Dokumen : <span class="label label-success">Sudah ditandangani digital</span>
                @else
                    Status Dokumen : <span class="label label-danger">Belum ditandangani digital</span>
                @endif



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
            <b>Verifikator Teknis :</b> {{ $data->verifikator_teknis }} <br>
            @if ($data->number_letter)
                <b>Nomor Surat:</b> {{ $data->number_letter }}<br>
            @endif
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.data pemohon -->
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-xs-12 table-responsive">
            @if ($data->file_permit)
                <embed type="application/pdf" src="{{ url('view-file?download_file=' . $data->file_permit) }}"
                    width="100%" height="900"></embed>
            @else
                <embed type="application/pdf" src="{{ url('view-file?download_file=' . $data->temp_file_permit) }}"
                    width="100%" height="900"></embed>
            @endif

            <hr>
            <!-- form start -->
            <form class="form-prevent" action="{{ url('admin-panel/setApproval_1') }}" method="post"
                enctype="multipart/form-data" autocomplete="off">
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

                    @if ($to == 'KEPALA DINAS')
                        <div class="form-group">
                            <label>NO. NIK PIMPINAN</label>
                            <input type="text" class="form-control" name="nik" value="7302024403670001"> 
                        </div>
                        <input type="hidden" class="form-control" name="signed_file"
                            value="{{ $data->temp_file_permit }}">
                        <div class="form-group">
                            <label>PASSPHRASE
                                <br>
                                <span class="text-red">(Masukan PASSPHRASE akun anda untuk menandatangi dokumen
                                    ini secara elektronik, Apabila perlu perbaikan kosongkan passphrase)</span>
                            </label>
                            <input type="text" class="form-control" name="passphrase" id="passphrase" value="">

                        </div>
                    @endif

                    <div class="form-group">
                        <label>CATATAN {{ $to }}</label>
                        <textarea name="note_pimpinan" class="form-control" id="" cols="10" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Hasil Verifikasi
                        </label>
                        <select name="hasil" id="hasil" class="form-control">
                            <option value="0"> Format surat perlu perbaikan</option>
                            <option value="1" selected> Format surat disetujui</option>
                        </select>
                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    {{-- <button type="submit" class="btn btn-success pull-right ">Setujui & Lanjut <i
                            class="fa fa-arrow-right"></i>
                    </button> --}}
                    <a href=""></a>
                    <button class="btn btn-success button-prevent pull-right" type="submit">
                        <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i>
                            Loading...
                        </div>
                        <div class="hide-text">Setujui & Lanjut</div>
                    </button>
                </div>
            </form>
            @php
                Admin::style('.spinner {
                                    display: none;
                                }');
                Admin::script('
                        (function() {
                                $(".form-prevent").on("submit", function() {
                                    $(".button-prevent").attr("disabled", "true");
                                    $(".spinner").show();
                                    $(".hide-text").hide();
                                })
                        })
();
                    
                    ');
            @endphp
            <hr>
            <div class="box box-info box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Pemohon</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>

                <div class="box-body" style="">
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
                                            <td><label class="label label-success"> <i class="fa fa-check"></i>
                                                    OK</label> </td>

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
                                            <td><label class="label label-success"> <i class="fa fa-check"></i>
                                                    OK</label> </td>
                                            <td>
                                                <a class="btn btn-dropbox"
                                                    href="{{ url('view-file?download_file=' . $doc->file_document) }}"
                                                    target="_blank" rel="noopener noreferrer"> <i
                                                        class="fa fa-eye"></i> </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>

            </div>

        </div>
    </div>
    <hr>





</section>
