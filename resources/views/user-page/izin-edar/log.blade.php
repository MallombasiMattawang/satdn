@extends('layouts.user-page.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            History Permohonan Sats-DN
                        </h1>

                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-body px-0">
                @forelse ( $historyServices as $item)
                    <div class="d-flex align-items-center justify-content-between px-4">
                        <div class="d-flex align-items-center">

                            <div class="ms-4">
                                <div class="small">{{ $item->invoice }} - {{ $item->jenis_tsl }}</div>
                                <div class="text-xs text-muted">{{ tgl_indo($item->created_at) }}
                                    @if ($item->status == 'VERIFIKASI DOKUMEN DITOLAK' || $item->status == 'VERIFIKASI TEKNIS DITOLAK')
                                        <span class="badge bg-danger text-white ">Ditolak</span>
                                    @elseif ($item->status == 'UPLOAD DOC.')
                                        <span class="badge bg-info text-white ">Upload Doc</span>

                                    @elseif ($item->date_end_progres != null)
                                        <span class="badge bg-success text-white ">Selesai</span>
                                    @else
                                        <span class="badge bg-warning text-white ">Verifikasi</span>
                                    @endif
                                    <span class="badge bg-primary text-white ">{{ $item->dari }} - {{ $item->ke }} </span>
                                    <span class="badge bg-primary text-white ">Jml Kirim: {{ $item->jumlah_kirim }} {{ $item->satuan }}</span>


                                </div>

                            </div>
                        </div>
                        <div class="ms-4 small">
                                <a href="{{ route('izin.edar.log-detail', $item->id) }}" class="btn btn-primary"> <i
                                        data-feather="eye"></i></a>
                        </div>
                    </div>
                    <hr />

                @empty
                    <div class="alert alert-info" style="margin: 10px">
                        Belum ada permohonan izin
                    </div>



                @endforelse

                <div class="table-responsive">
                    {{ $historyServices->links('vendor.pagination.custom') }}
                </div>



            </div>

        </div>
    </div>


@endsection
