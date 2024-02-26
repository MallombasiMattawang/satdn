@extends('layouts.user-page.app')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">{{ $service->name }}</h3>

        <div class="row">
            <div id="default">

                <!-- Component Preview-->
                <div class="sbp-preview">
                    <br>
                    <div class="table-responsive">
                        <br>
                        <div class="step step-danger mb-5">
                            <div class="step-item active">
                                <a class="step-item-link" href="#!">Isi Formulir pemohon</a>
                            </div>
                            <div class="step-item ">
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
                        <!-- Code sample-->
                        <ul class="nav nav-tabs" id="formsDefaultTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active me-1" id="formsDefaultHtmlTab" data-bs-toggle="tab"
                                    href="#formsDefaultHtml" role="tab" aria-controls="formsDefaultHtml"
                                    aria-selected="true">
                                    <i class="fa fa-user"></i>
                                    <!-- <i class="fab fa-html5 text-orange me-1"></i> Font Awesome fontawesome.com -->
                                    Biodata
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="formsDefaultPugTab" data-bs-toggle="tab"
                                    href="#formsDefaultPug" role="tab" aria-controls="formsDefaultPug"
                                    aria-selected="false">
                                    <i class="fa fa-file"></i>
                                    Dokumen
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes-->
                        <div class="tab-content">
                            <div class="tab-pane active" id="formsDefaultHtml" role="tabpanel"
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
                                        <form class="form-prevent" action="{{ route('store-service') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                                            <input type="hidden" name="admin_teknis" value="{{ $service->admin_teknis }}">
                                            <input type="hidden" name="format_number"
                                                value="{{ $service->format_number }}">

                                            <div class="row gx-3">
                                                <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="applicant_name">Nama pemohon</label>
                                                    <input class="form-control" id="applicant_name" name="applicant_name"
                                                        type="text" placeholder="" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="nik">NIK (Nomor Induk KTP)</label>
                                                    <input class="form-control" id="nik" name="nik" type="text"
                                                        placeholder="" required>
                                                </div>


                                            </div>
                                            {{-- <div class="row gx-3">                                                --}}
                                                {{-- <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="no_kk">No KK (Kartu Keluarga)</label>
                                                    <input class="form-control" id="no_kk" name="no_kk" type="text"
                                                        placeholder="" required>
                                                </div> --}}
                                                {{-- <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="npwp">NPWP</label>
                                                    <input class="form-control" id="npwp" name="npwp" type="text"
                                                        placeholder="" required>
                                                </div> --}}

                                            {{-- </div> --}}
                                            <div class="row gx-3">

                                                <div class="mb-3 col-md-12">
                                                    <label class="small mb-1" for="place_of_birth">Tempat Lahir</label>
                                                    <input class="form-control" id="place_of_birth" name="place_of_birth"
                                                        type="text" placeholder="" required>
                                                </div>
                                                <div class="mb-3 col-md-12 ">
                                                    <label class="small mb-1" for="date_of_birth">Tanggal Lahir</label>

                                                    <input class="form-control" id="date_of_birth" name="date_of_birth"
                                                        type="date" placeholder="" required>
                                                </div>

                                            </div>
                                            <div class="row gx-3">
                                                <div class="mb-3 col-md-3">
                                                    <label class="small mb-1" for=""> Jenis Kelamin</label>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <input class="form-check-input" id="flexRadioSolid1"
                                                                type="radio" name="gender" value="L" checked>
                                                            <label class="form-check-label"
                                                                for="flexRadioSolid1">Laki-laki</label>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <input class="form-check-input" id="flexRadioSolid2"
                                                                type="radio" name="gender" value="P">
                                                            <label class="form-check-label"
                                                                for="flexRadioSolid2">Perempuan</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label class="small mb-1" for="phone_number">Nomor Telepon</label>
                                                    <input class="form-control" id="phone_number" name="phone_number"
                                                        type="text" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="address_ktp">Alamat Sesuai KTP</label>
                                                <textarea class="form-control" id="address_ktp" name="address_ktp" rows="5"></textarea>
                                            </div>
                                            <div class="row gx-3">
                                                @foreach ($service->inputs as $input)
                                                    @if ($input->option == 'PEMOHON')
                                                        <div class="mb-3 col-md-6">
                                                            <label class="small mb-1"
                                                                for="{{ $input->id }}">{{ $input->input }}</label>
                                                            <input class="form-control" id="{{ $input->id }}"
                                                                name="{{ $input->id }}" type="text" placeholder=""
                                                                required>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-light" type="button">Back</button>
                                                    <button class="btn btn-primary button-prevent" type="submit">
                                                        <div class="spinner"><i role="status"
                                                                class="spinner-border spinner-border-sm"></i> Loading...
                                                        </div>
                                                        <div class="hide-text">Register</div>
                                                    </button>
                                                </div>
                                            </div>

                                        </form>


                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane" id="formsDefaultPug" role="tabpanel"
                                aria-labelledby="formsDefaultPugTab">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="alert alert-danger" role="alert">Isi terlebih dahulu data pemohon
                                            sebelum unggah dokumen!</div>
                                        <p class="badge bg-success text-white me-2">Kelengkapan berkas yang diperlukan</p>
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Dokumen (tanda <span class="text-red">*</span> Dokumen wajib diupload)</th>
                                                    <th>Jenis File </th>
                                                    <th>Ukuran File</th>
                                                </tr>
                                                @foreach ($service->documents as $doc)
                                                    <tr>
                                                        <td>
                                                            @if ($doc->required == 1)
                                                                <span class="text-red">*</span>
                                                            @endif
                                                            {{ $doc->name }}
                                                        </td>
                                                        <td><span
                                                                class="badge bg-danger text-white me-2">{{ $doc->type_file }}</span>
                                                        </td>
                                                        <td><span
                                                                class="badge bg-warning text-white me-2">{{ $doc->max_file }}kb</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
                <!--h-->



            </div>


        </div>
    @endsection
