@extends('layouts.user-page.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Proses Layanan
                        </h1>
                        <div class="page-header-subtitle">{{ $progresDocument->service->name }}</div>
                        @php
                            $tgl1 = $progresDocument->date_start_progres; // pendefinisian tanggal awal
                            $tgl2 = date('Y-m-d', strtotime('+6 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
                            echo 'Estimasi Selesai:  '.$tgl2;
                        @endphp
                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                            <div class="timeline-item-marker-text">{{ $progresDocument->dateStart() }}</div>
                            <div class="timeline-item-marker-indicator bg-primary-soft text-primary"><i
                                    data-feather="check"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary">Proses izin</h5>
                                    No.Registrasi : {{ $progresDocument->no_invoice }} <br>
                                    Pemohon : {{ $progresDocument->applicant_name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                            <div class="timeline-item-marker-text">{{ $progresDocument->dateDoc() }}</div>
                            <div class="timeline-item-marker-indicator bg-success-soft text-success"><i
                                    data-feather="file"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-success">
                                        Verifikasi Dokumen <br>
                                        @if ($progresDocument->status == 'VERIFIKASI DOKUMEN DITOLAK')
                                            <span class="badge bg-danger text-white ">Ditolak</span>
                                        @endif
                                    </h5>
                                    @if ($progresDocument->date_verified_doc)
                                        <br>
                                        <div class="alert alert-warning">
                                            Hasil Verifikasi {{ $progresDocument->note_verified_doc }}
                                            &nbsp;
                                            @if ($progresDocument->status == 'VERIFIKASI DOKUMEN DITOLAK')
                                                <a href="{{ route('getDocument', $progresDocument->id) }}"
                                                    class="btn btn-sm btn-warning text-white">Ajukan Kembali</a>
                                            @endif
                                        </div>
                                    @else
                                        <div class=""> Menunggu... </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                            <div class="timeline-item-marker-text">{{ $progresDocument->dateTeknis() }}</div>
                            <div class="timeline-item-marker-indicator bg-secondary-soft text-secondary"><i
                                    data-feather="map"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-secondary">Rekomendasi Teknis</h5>
                                    @if ($progresDocument->date_verified_teknis)
                                        Hasil Rekomendasi {{ $progresDocument->note_verified_teknis }}
                                    @else
                                        <div class=""> Menunggu... </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                            <div class="timeline-item-marker-text">{{ $progresDocument->dateEnd() }}</div>
                            <div class="timeline-item-marker-indicator bg-warning-soft text-warning"><i
                                    data-feather="send"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-warning">Hasil Permohonan</h5>
                                    @if ($progresDocument->date_end_progres)
                                        <div class="alert alert-success">
                                            Selamat izin anda telah tebit dengan nomor :
                                            <b>{{ $progresDocument->number_letter }}</b>
                                            <hr>
                                            Sebelum mengunduh izin anda silahkan berikan penilaian dan testimoni dari
                                            pelayanan kami,
                                            agar kami selalu memberikan pelayanan terbaik. Terimakasih
                                        </div>
                                        @if ($progresDocument->ikm == 'YES')
                                            <a href="/uploads/{{ $progresDocument->file_permit }}" target="_blank"
                                                class="btn btn-success"><i data-feather="download"></i> &nbsp; Download</a>
                                        @endif

                                    @else
                                        <div class=""> Menunggu... </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
        @if ($progresDocument->file_permit)
            <div class="card mb-4">
                <div class="card-header">Bagaimana Pelayanan kami ?</div>
                <div class="card-body">
                    <form class="form-prevent" action="{{ route('ikm') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service" value="{{ $progresDocument->service->name }}">
                        <input type="hidden" name="name" value="{{ $progresDocument->applicant_name }}">
                        <input type="hidden" name="id" value="{{ $progresDocument->id }}">

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (testimony)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="testimony">Beri Testimoni</label>
                                <textarea {{ $progresDocument->ikm == 'YES' ? 'disabled' : '' }} name="testimony"
                                    class="form-control" id="testimony" cols="30" rows="10">
                                                    {{ $progresDocument->note_ikm }}
                                                </textarea>
                            </div>

                            <!-- Form Group (rating)-->
                            <div class="col-md-12 text-center">
                                <br>
                                <label class="small mb-1" for="inputFirstName">Beri Kami Nilai</label>
                                <input {{ $progresDocument->ikm == 'YES' ? 'disabled' : '' }} id="rating-input"
                                    type="text" title="" name="rate" value="{{ $progresDocument->rate_ikm }}" required />
                            </div>

                        </div>

                        <!-- Save changes button-->
                        <div class="text-center">

                            <button {{ $progresDocument->ikm == 'YES' ? 'disabled' : '' }}
                                class="btn btn-orange button-prevent" type="submit">
                                <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i>
                                    Loading...
                                </div>
                                <div class="hide-text">Kirim Testimoni</div>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        @endif

    </div>


@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/user-page/rating/js/star-rating.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var $inp = $('#rating-input');
            $inp.rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'sm',
                showClear: false
            });
            $inp.on('rating.change', function() {
                // alert('Nilai rating : '+$('#rating-input').val());
            });
        });
    </script>
@stop
