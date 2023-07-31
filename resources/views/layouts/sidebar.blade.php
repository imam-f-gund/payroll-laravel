<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" width="25%">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @if (Auth::user()->jabatan_id == 2)
      <!-- Heading -->
     <div class="sidebar-heading">
        Gaji Pegawai
    </div>

    
    <li class="nav-item">
        <a class="nav-link" href="{{ url('gaji-approval') }}">
            <i class="fas fa-check"></i>
            <span>Gaji Pegawai</span></a>
    </li>
    @elseif (Auth::user()->jabatan_id == 1)
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesData" aria-expanded="true"
            aria-controls="collapsePagesData">
            <i class="fas fa-circle"></i>
            <span>Data</span>
        </a>
        <div id="collapsePagesData" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data:</h6>
                <a class="collapse-item" href="{{ url('jabatan') }}">Data Jabatan</a>
                <a class="collapse-item" href="{{ url('tambahan') }}">Data Tambahan</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Pegawai
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('detailpegawai') }}">
            <i class="fas fa-user-edit"></i>
            <span>Data Pegawai</span></a>
    </li>

     <!-- Heading -->
     <div class="sidebar-heading">
        Gaji Pegawai
    </div>

    
    <li class="nav-item">
        <a class="nav-link" href="{{ url('gaji') }}">
            <i class="fas fa-check"></i>
            <span>Gaji Pegawai</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Presensi
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('presensi') }}">
            <i class="fas fa-check"></i>
            <span>Presensi</span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
