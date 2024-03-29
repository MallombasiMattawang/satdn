@extends('layouts.user-page.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            Proses Layanan SATS-DN
                        </h1>
                        <div class="page-header-subtitle">{{ $progresDocument->jenis_tsl }}</div>
                        @php
                            $tgl1 = $progresDocument->created_at; // pendefinisian tanggal awal
                            $tgl2 = date('Y-m-d', strtotime('+3 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
                            echo 'Estimasi Selesai:  ' . tgl_indo($tgl2);
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
                            <div class="timeline-item-marker-text">{{ tgl_indo($progresDocument->created_at) }}</div>
                            <div class="timeline-item-marker-indicator bg-primary-soft text-primary"><i
                                    data-feather="check"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary">Proses izin</h5>
                                    No.Registrasi : {{ $progresDocument->invoice }} <br>
                                    Kategori : SATS-DN PEMEGANG IZIN <br>
                                    <span class="badge bg-primary text-white ">{{ $progresDocument->dari }} -
                                        {{ $progresDocument->ke }} </span>
                                    <span class="badge bg-primary text-white ">Jml Kirim:
                                        {{ $progresDocument->jumlah_kirim }} {{ $progresDocument->satuan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                            <div class="timeline-item-marker-text">{{ tgl_indo($progresDocument->date_verified_teknis) }}
                            </div>
                            <div class="timeline-item-marker-indicator bg-success-soft text-success"><i
                                    data-feather="file"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-success">
                                        Verifikasi Dokumen <br>
                                        @if ($progresDocument->status == 'VERIFIKASI TEKNIS DITOLAK')
                                            <span class="badge bg-danger text-white ">Ditolak</span>
                                        @endif
                                    </h5>
                                    @if ($progresDocument->date_verified_teknis)
                                        <br>
                                        <div class="alert alert-warning">
                                            @if ($progresDocument->status == 'VERIFIKASI TEKNIS DITOLAK')
                                                Dokumen permohonan ditolak
                                                @else
                                                Verifikasi done
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
                            <div class="timeline-item-marker-text">{{ tgl_indo($progresDocument->date_verified_teknis) }}
                            </div>
                            <div class="timeline-item-marker-indicator bg-secondary-soft text-secondary"><i
                                    data-feather="map"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-secondary">Verifikasi Teknis</h5>
                                    @if ($progresDocument->date_verified_teknis)
                                        <div class="alert alert-warning">
                                          {{ $progresDocument->status }}
                                        </div>
                                        Catatan Teknis: {{ $progresDocument->status_ket }}
                                    @else
                                        <div class=""> Menunggu... </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                            <div class="timeline-item-marker-text">{{ $progresDocument->tgl_dikeluarkan }}</div>
                            <div class="timeline-item-marker-indicator bg-warning-soft text-warning"><i
                                    data-feather="send"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-warning">Hasil Permohonan</h5>
                                    @if ($progresDocument->tgl_dikeluarkan)
                                        <div class="alert alert-success">
                                            Selamat izin kamu telah tebit dengan nomor :
                                            <b>{{ $progresDocument->no_satdn }}</b>
                                            <hr>
                                            Silahkan datang dan mengambil SATS-DN kamu di lokasi penerbitan SATS-DN yang
                                            kamu pilih sebelumnya "{{ $progresDocument->adminTeknis->name }}"
                                        </div>
                                    @else
                                        @if ($progresDocument->status == 'VERIFIKASI TEKNIS DITOLAK')
                                            -
                                        @else
                                            <div class=""> Menunggu... </div>
                                        @endif

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
                                <textarea {{ $progresDocument->ikm == 'YES' ? 'disabled' : '' }} name="testimony" class="form-control" id="testimony"
                                    cols="30" rows="10">
                                                    {{ $progresDocument->note_ikm }}
                                                </textarea>
                            </div>

                            <!-- Form Group (rating)-->
                            <div class="col-md-12 text-center">
                                <br>
                                <label class="small mb-1" for="inputFirstName">Beri Kami Nilai</label>
                                <input {{ $progresDocument->ikm == 'YES' ? 'disabled' : '' }} id="rating-input"
                                    type="text" title="" name="rate" value="{{ $progresDocument->rate_ikm }}"
                                    required />
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
