<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-header text-center" style="padding:10px;">
        <img class="img-fluid" src="{{ asset('assets/img/bksda-sulsel-logo.jpg') }}" alt="" width="100">
    </div>
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">

            <!-- Sidenav Menu Heading (menu layanan)-->
            <div class="sidenav-menu-heading">Menu Layanan</div>
            <a class="nav-link" href="{{ route('home') }}">
                <div class="nav-link-icon"><i data-feather="grid"></i></div>
                Daftar Perizinan
            </a>

            <!-- Sidenav Heading (Custom)-->
            <div class="sidenav-menu-heading">Perizinan saya</div>
            <!-- Sidenav Accordion (Pages)-->
            <a class="nav-link" href="{{ route('izin.edar') }}">
                <div class="nav-link-icon"><i data-feather="filter"></i></div>
                Izin Peredaran TSL
            </a>
            <a class="nav-link" href="{{ route('history') }}">
                <div class="nav-link-icon"><i data-feather="filter"></i></div>
                Tracking Izin
            </a>


        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>
