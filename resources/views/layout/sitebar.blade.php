<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <i class="fas fa-desktop"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Netsian Komputer</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MANAGEMENT
    </div>

     <!-- Nav Item - Charts -->
     <li class="nav-item @yield('transaksi')">
        <a class="nav-link" href="/transaksi">
            <i class="fas fa-book"></i>
            <span>Data Transaksi</span></a>
    </li>

    <li class="nav-item @yield('kategori')">
        <a class="nav-link" href="/kategori">
            <i class="fas fa-boxes"></i>
            <span>Kategori Barang</span></a>
    </li>

    <li class="nav-item @yield('laporan')">
        <a class="nav-link" href="/laporan">
            <i class="fas fa-shopping-cart"></i>
            <span>Laporan Penjualan</span></a>
    </li>
     <!-- Heading -->
     @if (Auth::check())
        @if (Auth::user()->role == "admin")
            <div class="sidebar-heading">
                User
            </div>
            <li class="nav-item @yield('user')">
                <a class="nav-link" href="/user">
                    <i class="fas fa-user"></i>
                    <span>Data User</span></a>
            </li>
        @endif
    @endif




</ul>
<!-- End of Sidebar -->
