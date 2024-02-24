@extends('layouts.user-page.app')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">{{ $service->name }}</h3>

        <div class="row">
            <div id="default">

                <!-- Component Preview-->
                <div class="sbp-preview">

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
                                    Formulir Pemohon
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="formsDefaultPugTab" data-bs-toggle="tab"
                                    href="#formsDefaultPug" role="tab" aria-controls="formsDefaultPug"
                                    aria-selected="false">
                                    <i class="fa fa-file"></i>
                                    Unggah Dokumen
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
                                            <div class="row gx-3">
                                                <div class="mb-3 col-md-6">
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
                                                <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="phone_number">Nomor Telepon</label>
                                                    <input class="form-control" id="phone_number" name="phone_number"
                                                        type="text" placeholder="" required
                                                        value="{{ $biodata->phone_number }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="address_ktp">Alamat Sesuai KTP</label>
                                                <textarea class="form-control" id="address_ktp" name="address_ktp"
                                                    rows="5">{{ $biodata->address_ktp }}</textarea>
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Dokumen </th>
                                                    <th width="140">View </th>
                                                    <th>Unggah</th>
                                                </tr>
                                                @foreach ($progresDocument as $doc)
                                                    <tr>
                                                        <td> {{ $doc->document_name }} <br>
                                                            <span class="badge bg-danger text-white small"> file
                                                                {{ $doc->document_type }}</span>
                                                            <span class="badge bg-warning text-white small">max size
                                                                {{ $doc->document_max }}kb</span>
                                                            @if ($doc->document_file)
                                                                <a href="#" class="badge bg-success text-white small"><i
                                                                        class="fa fa-eye"></i> Preview</a>

                                                            @endif
                                                        </td>
                                                        <form action="#" method="POST" class="form-prevent inline-block">
                                                            @csrf
                                                            <td>

                                                                <input type="file" class="form-control">

                                                            </td>
                                                            <td>
                                                                <button type="submit"
                                                                    class="btn btn-primary button-prevent">
                                                                    <div class="spinner"><i role="status"
                                                                            class="spinner-border spinner-border-sm"></i>
                                                                        Loading...
                                                                    </div>
                                                                    <div class="hide-text">Upload</div>
                                                                </button>


                                                            </td>
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <br>
                        <div class="step step-danger mb-5">
                            <div class="step-item ">
                                <a class="step-item-link" href="#!">Isi Formulir pemohon</a>
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

                </div>
                <!--h-->



            </div>


        </div>
    @endsection
