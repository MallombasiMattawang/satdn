@extends('layouts.user-page.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Daftar Izin Peredaran Saya
                        </h1>

                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-body px-0">
                @forelse ( $data as $item)
                    <div class="d-flex align-items-center justify-content-between px-4">
                        <div class="d-flex align-items-center">

                            <div class="ms-4">
                                <div class="small">{{ $item->nama_perusahaan }} - {{ $item->jenis_tsl }}</div>
                                <div class="text-xs text-muted">{{ $item->no_sk_oss }}
                                    <br>
                                    @if ($item->active == 'N')
                                        <span class="badge bg-danger text-white ">Non Active</span>
                                    @else
                                        <span class="badge bg-success text-white ">Active</span>
                                    @endif
                                    <span class="badge bg-primary text-white ">Expired : {{ tgl_indo($item->tgl_habis_sk) }}</span>
                                    <span class="badge bg-info text-white ">Total Kuota : {{ $item->kuota }}</span>
                                    <span class="badge bg-black text-white ">Kuota digunakan : {{ $item->kuota_digunakan }}</span>
                                    <span class="badge bg-orange text-white ">Sisa Kuota : {{ $item->kuota_sisa }}</span>

                                </div>

                            </div>
                        </div>
                        <div class="ms-4 small">


                                <a href="{{ route('izin.edar.create', [$item->id]) }}" class="btn btn-yellow"> Buat SATSDN</a>



                        </div>
                    </div>
                    <hr />

                @empty
                    <div class="alert alert-info" style="margin: 10px">
                        Belum memiliki izin edar TSL
                    </div>



                @endforelse

                <div class="table-responsive">
                    {{ $data->links('vendor.pagination.custom') }}
                </div>



            </div>

        </div>
    </div>


@endsection
