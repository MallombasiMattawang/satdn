@extends('layouts.user-page.app')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">{{ $service->name }}</h3>

        <div class="row">
            <div id="default">

                <!-- Component Preview-->
                <div class="sbp-preview">
                    <br><br><br>
                    <div class="table-responsive">

                        <div class="step step-danger mb-5">
                            <div class="step-item ">
                                <a class="step-item-link" href="#!">Formulir pemohon</a>
                            </div>
                            <div class="step-item active">
                                <a class="step-item-link" href="#!">Unggah Dokumen</a>
                            </div>
                            <div class="step-item ">
                                <a class="step-item-link" href="#!">Verifikasi Berkas</a>
                            </div>
                            <div class="step-item ">
                                <a class="step-item-link" href="#!">Rekomendasi Tim Teknis</a>
                            </div>
                            <div class="step-item">
                                <a class="step-item-link disabled" href="#!" tabindex="-1" aria-disabled="true">Selesai</a>
                            </div>
                        </div>
                    </div>
                    <div class="sbp-preview-content">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i> {{ session()->get('message') }}
                            </div>
                        @endif
                        <!-- Code sample-->
                        <ul class="nav nav-tabs" id="formsDefaultTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  me-1" id="formsDefaultHtmlTab" data-bs-toggle="tab"
                                    href="#formsDefaultHtml" role="tab" aria-controls="formsDefaultHtml"
                                    aria-selected="true">
                                    <i class="fa fa-user"></i>
                                    <!-- <i class="fab fa-html5 text-orange me-1"></i> Font Awesome fontawesome.com -->
                                    Biodata
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="formsDefaultPugTab" data-bs-toggle="tab"
                                    href="#formsDefaultPug" role="tab" aria-controls="formsDefaultPug"
                                    aria-selected="false">
                                    <i class="fa fa-file"></i>
                                    Dokumen
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes-->
                        <div class="tab-content">
                            <div class="tab-pane " id="formsDefaultHtml" role="tabpanel"
                                aria-labelledby="formsDefaultHtmlTab">
                                <div class="card mb-4">
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
                                        <form class="form-prevent" action="{{ route('updateBiodata') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $biodata->id }}">

                                            <div class="row gx-3">

                                                <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="applicant_name">Nama pemohon</label>
                                                    <input class="form-control" id="applicant_name" name="applicant_name"
                                                        type="text" placeholder="" required
                                                        value="{{ $biodata->applicant_name }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="nik">NIK (Nomor Induk KTP)</label>
                                                    <input class="form-control" id="nik" name="nik" type="text"
                                                        placeholder="" required value="{{ $biodata->nik }}">
                                                </div>

                                            </div>
                                            {{-- <div class="row gx-3"> --}}

                                               
                                                {{-- <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="no_kk">No.KK (Kartu Keluarga)</label>
                                                    <input class="form-control" id="no_kk" name="no_kk" type="text"
                                                        placeholder="" required value="{{ $biodata->no_kk }}">
                                                </div> --}}
                                                {{-- <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="npwp">NPWP</label>
                                                    <input class="form-control" id="npwp" name="npwp" type="text"
                                                        placeholder="" required value="{{ $biodata->npwp }}">
                                                </div> --}}

                                            {{-- </div> --}}
                                            <div class="row gx-3">

                                                <div class="mb-3 col-md-12">
                                                    <label class="small mb-1" for="place_of_birth">Tempat Lahir</label>
                                                    <input class="form-control" id="place_of_birth" name="place_of_birth"
                                                        type="text" placeholder="" required
                                                        value="{{ $biodata->place_of_birth }}">
                                                </div>
                                                <div class="mb-3 col-md-12 ">
                                                    <label class="small mb-1" for="date_of_birth">Tanggal Lahir</label>

                                                    <input class="form-control" id="date_of_birth" name="date_of_birth"
                                                        type="date" placeholder="" required
                                                        value="{{ $biodata->date_of_birth }}">
                                                </div>

                                            </div>
                                            <div class="row gx-3">
                                                <div class="mb-3 col-md-3">
                                                    <label class="small mb-1" for=""> Jenis Kelamin</label>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <input class="form-check-input" id="flexRadioSolid1"
                                                                type="radio" name="gender" value="L"
                                                                {{ $biodata->gender == 'L' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexRadioSolid1">Laki-laki</label>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <input class="form-check-input" id="flexRadioSolid2"
                                                                type="radio" name="gender" value="P"
                                                                {{ $biodata->gender == 'P' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexRadioSolid2">Perempuan</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label class="small mb-1" for="phone_number">Telepon/Hp</label>
                                                    <input class="form-control" id="phone_number" name="phone_number"
                                                        type="text" placeholder="" required
                                                        value="{{ $biodata->phone_number }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="address_ktp">Alamat Sesuai KTP</label>
                                                <textarea class="form-control" id="address_ktp" name="address_ktp" rows="5">{{ $biodata->address_ktp }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-light" type="button">Back</button>
                                                    <button class="btn btn-primary button-prevent" type="submit">
                                                        <div class="spinner"><i role="status"
                                                                class="spinner-border spinner-border-sm"></i> Loading...
                                                        </div>
                                                        <div class="hide-text">Update</div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="formsDefaultPug" role="tabpanel"
                                aria-labelledby="formsDefaultPugTab">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <!-- Response message -->
                                            <div class="alert displaynone" id="responseMsg"></div>

                                            <!-- File preview -->
                                            <div id="filepreview" class="displaynone">
                                                <img src="" class="displaynone" with="200px" height="200px"><br>

                                                <a href="#" class="displaynone">Click Here..</a>
                                            </div>
                                            <!-- Error -->
                                            <div class='alert alert-danger mt-2 d-none text-danger' id="err_file">
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>No.Dok</th>
                                                    <th> Dokumen (<i>tanda <span class="text-red">*</span> Dokumen wajib diupload</i>)</th>
                                                    <th>View </th>
                                                    <th>Unggah</th>
                                                </tr>
                                                <?php $indexId = -1;
                                                $no = 0; ?>
                                                @foreach ($progresDocument as $doc)
                                                    <?php $indexId++;
                                                    $no++; ?>
                                                    <tr>
                                                        <td class="text-center">{{ $no }}</td>
                                                        <td> 
                                                            @if ($doc->required == 1)
                                                                <span class="text-red">*</span>
                                                            @endif
                                                            {{ $doc->document_name }} <br>
                                                            <span class="badge bg-danger text-white small"> file
                                                                {{ $doc->document_type }}</span>
                                                            <span class="badge bg-warning text-white small">max size
                                                                {{ $doc->document_max }}kb</span>
                                                            @if ($doc->file_document)
                                                                <a target="_blank" rel="noopener noreferrer"
                                                                    href="/uploads/{{ $doc->file_document }}"
                                                                    class="badge bg-success text-white small"><i
                                                                        class="fa fa-check"></i> OK</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <!-- Form -->
                                                            <input type="file" class="form-control file"
                                                                id="file-{{ $indexId }}" name='file'
                                                                data-id="{{ $doc->id }}"
                                                                data-index="{{ $indexId }}">
                                                        </td>
                                                        <td>
                                                            <button type="button" data-index="{{ $indexId }}"
                                                                data-id="{{ $doc->id }}"
                                                                id="submit-{{ $indexId }}"
                                                                class='btn btn-success submit '>
                                                                <div class="spinner"><i role="status"
                                                                        class="spinner-border spinner-border-sm"></i> Submit
                                                                </div>
                                                                <div class="hide-text">Submit <span
                                                                        class="ket_id"></span></div>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card card-header-actions">

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
                                <div class="alert alert-danger">
                                    <form action="{{ route('updateToVerified') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $biodata->id }}">
                                        <div class="form-check">
                                            <input class="form-check-input" id="flexCheckDefault" type="checkbox"
                                                value="pernyataan" name="pernyataan" required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Dengan ini menyatakan bahwa, dokumen-dokumen kelengkapan
                                                administrasi yang saya sampaikan dalam permohonan
                                                <b>{{ $service->name }}</b>
                                                adalah <b>BENAR dan
                                                    ASLI.</b> Adapun apabila di kemudian hari diketemukan bahwa dokumen
                                                tersebut
                                                PALSU, maka Saya bersedia menanggung sanksi yang akan diberikan atas
                                                tindakan pemalsuan dokumen sesuai ketentuan peraturan yang berlaku
                                            </label>
                                        </div>
                                        <br>
                                        
                                        @if ($countDocNull == $countDoc)
                                            <div class="text-center"><button type="submit"
                                                    class="btn btn-primary align-items-center">
                                                    Proses Izin</button></div>
                                        @else
                                            <div class="text-center">
                                                <a href="#" class="btn btn-light">Lengkapi Dokumen Sebelum melenjutkan</a>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!--h-->



            </div>


        </div>
    @endsection

    @section('footer_scripts')

        <script type="text/javascript">
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            $(document).ready(function() {
                $('.submit').prop("disabled",
                    true); // Element(s) are now enabled.
                $('.file').on('change', function() {
                    //uploadFile();
                    var fileIndexId = $(this).data('index');

                    $('.file').prop("disabled",
                        true); // Element(s) are now disabled.

                    $('#file-' + fileIndexId).prop("disabled",
                        false); // Element(s) are now enabled.

                    $('#submit-' + fileIndexId).prop("disabled",
                        false); // Element(s) are now enabled.
                });

                $('.submit').click(function() {

                    $('.submit').attr('disabled', 'true');
                    $('.spinner').show();
                    $('.hide-text').hide();

                    // Get the selected file
                    var indexId = $(this).data('index');
                    var serviceId = $(this).data('id');
                    var files = $('.file')[indexId].files;

                    if (files.length > 0) {
                        var fd = new FormData();

                        // Append data 
                        fd.append('file', files[0]);
                        fd.append('_token', CSRF_TOKEN);
                        fd.append('id', serviceId);

                        // Hide alert 
                        $('#responseMsg').hide();

                        // AJAX request 
                        $.ajax({
                            url: "{{ route('uploadDocument') }}",
                            method: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {

                                // Hide error container
                                $('#err_file').removeClass('d-block');
                                $('#err_file').addClass('d-none');

                                if (response.success == 1) { // Uploaded successfully
                                    // animate loading
                                    $('.submit').prop("disabled",
                                        false); // Element(s) are now enabled.
                                    $('.spinner').hide();
                                    $('.hide-text').show();

                                    // Response message
                                    $('#responseMsg').removeClass("alert-danger");
                                    $('#responseMsg').addClass("alert-success");
                                    $('#responseMsg').html(response.message);
                                    $('#responseMsg').show();
                                    window.location.reload();

                                    // File preview
                                    $('#filepreview').show();
                                    $('#filepreview img,#filepreview a').hide();
                                    if (response.extension == 'jpg' || response.extension ==
                                        'jpeg' || response.extension == 'png') {

                                        $('#filepreview img').attr('src', response.filepath);
                                        $('#filepreview img').show();
                                    } else {
                                        $('#filepreview a').attr('href', response.filepath).show();
                                        $('#filepreview a').show();
                                    }
                                } else if (response.success == 2) { // File not uploaded
                                    $('.submit').prop("disabled",
                                        false); // Element(s) are now enabled.
                                    $('.spinner').hide();
                                    $('.hide-text').show();

                                    // Response message
                                    $('#responseMsg').removeClass("alert-success");
                                    $('#responseMsg').addClass("alert-danger");
                                    $('#responseMsg').html(response.message);
                                    $('#responseMsg').show();
                                } else {
                                    $('.submit').prop("disabled",
                                        false); // Element(s) are now enabled.
                                    $('.spinner').hide();
                                    $('.hide-text').show();
                                    // Display Error
                                    $('#err_file').text(response.error);
                                    $('#err_file').removeClass('d-none');
                                    $('#err_file').addClass('d-block');
                                    $('.file').prop("disabled",
                                        false); // Element(s) are now enabled.
                                    $('.submit').prop("disabled",
                                        true); // Element(s) are now enabled.
                                }
                            },
                            error: function(response) {
                                console.log("error : " + JSON.stringify(response.message));
                            }
                        });
                    } else {
                        var no = indexId + 1;
                        alert('File Dokumen Nomor ' + no + ' Belum dipilih');
                        $('.submit').prop("disabled",
                            false); // Element(s) are now enabled.
                        $('.spinner').hide();
                        $('.hide-text').show();
                    }

                });
            });
        </script>
    @stop
