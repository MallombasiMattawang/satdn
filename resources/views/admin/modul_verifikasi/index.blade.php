@extends('admin.index')

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                         Layanan Perizinan
                    </h1>

                </div>

            </div>
        </div>
    </div>
</header>
    <div class="container-xl px-4 mt-n10">
        

        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Navbar Search-->
            <form class=" d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control form-search" type="text" placeholder="Cari layanan..."
                        aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
                <br>
            </form>
            <div class="row div-search">
                @foreach ($services as $service)
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4" style="height: 120px">
                            <div class="card-body" >{{ $service->name }}</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link"  href="{{ route('getService', $service->id) }}"></a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>


    </div>
@endsection
