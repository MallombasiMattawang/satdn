<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - User</title>

    <link href="{{ asset('assets/user-page/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user-page/rating/css/star-rating.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('assets/user-page/rating/css/bootstrap.css') }}" rel="stylesheet" type="text/css"> --}}
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>

    <style>
        /* untuk menghilangkan spinner  */
        .spinner {
            display: none;
        }

        .displaynone {
            display: none;
        }

    </style>
</head>

<body class="nav-fixed">
    @section('header')
        @include('layouts.user-page.inc.header')
    @show
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @section('sidenav')
                @include('layouts.user-page.inc.sidenav')
            @show
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @section('footer')
                @include('layouts.user-page.inc.footer')
            @show
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/components/prism-core.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/plugins/autoloader/prism-autoloader.min.js"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('assets/user-page/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/user-page/js/custom.js') }}"></script>   


    @yield('footer_scripts')


</body>

</html>
