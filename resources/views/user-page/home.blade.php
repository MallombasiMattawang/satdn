@extends('layouts.user-page.app')

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user"></i>
                            
                        </div>
                         Layanan Perizinan
                    </h1>

                </div>

            </div>
        </div>
    </div>
</header>
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-body">
                <div class="row" >
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
                    <div class="row div-search" style="margin: auto !important">
                        @foreach ($services as $service)
                            <div class="col-xl-3 col-md-6 mb-2">
                                <a class="card lift lift-sm h-100" href="{{ route('getService', $service->id) }}">
                                    <div class="card-body">
                                        <p class="text-orange mb-2 text-center" >
                                           
                                            {{ $service->name }}
                                        </p>
                                        
                                    </div>
                                    
                                </a>
                                
                            </div>
                        @endforeach
                    </div>
        
        
                </div>
            </div>
            
        </div>
        


    </div>
@endsection
