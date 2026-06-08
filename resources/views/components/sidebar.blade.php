<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <!-- PROFILE SIDEBAR -->
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ Auth::check() 
    ? asset('template/assets/images/faces/sania.png') 
    : asset('template/assets/images/faces/face1.jpg') }}"
     class="img-circle elevation-2"
     style="width:35px; height:35px; object-fit:cover;"
     alt="User Image">
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">
                        {{ Auth::user()->name ?? 'User' }}
                    </span>
                    <span class="text-secondary text-small">
                        Administrator
                    </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- DASHBOARD -->
        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <!-- KATEGORI -->
        <li class="nav-item {{ request()->is('kategori*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kategori.index') }}">
                <span class="menu-title">Kategori</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>

        <!-- BUKU -->
        <li class="nav-item {{ request()->is('buku*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('buku.index') }}">
                <span class="menu-title">Buku</span>
                <i class="mdi mdi-book menu-icon"></i>
            </a>
        </li>

                <!-- SERTIFIKAT -->
        <li class="nav-item {{ request()->is('cetak-sertifikat') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('cetak.sertifikat') }}">
                <span class="menu-title">Sertifikat</span>
                <i class="mdi mdi-certificate menu-icon"></i>
            </a>
        </li>

        <!-- UNDANGAN -->
        <li class="nav-item {{ request()->is('cetak-undangan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('cetak.undangan') }}">
                <span class="menu-title">Undangan</span>
                <i class="mdi mdi-email menu-icon"></i>
            </a>
        </li>

        <!-- BARANG -->
        <li class="nav-item {{ request()->is('barang*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('barang.index') }}">
                <span class="menu-title">Tag Harga</span>
                <i class="mdi mdi-tag menu-icon"></i>
            </a>
        </li>

         <!-- SCAN BARCODE-->
        <li class="nav-item {{ request()->is('scan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('barcode.scan') }}">
                <span class="menu-title">Scan Barcode</span>
                <i class="mdi mdi-tag menu-icon"></i>
            </a>
        </li>

        <!-- MODUL JAVASCRIPT -->
<li class="nav-item {{ request()->is('modul-*') ? 'active' : '' }}">
    <a class="nav-link" data-bs-toggle="collapse" href="#modulJS" aria-expanded="false">
        <span class="menu-title">Modul Javascript</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-code-tags menu-icon"></i>
    </a>

    <div class="collapse {{ request()->is('modul-*') ? 'show' : '' }}" id="modulJS">
        <ul class="nav flex-column sub-menu">


            <!-- TABEL HTML -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('modul-js') ? 'active' : '' }}"
                   href="/modul-js">
                    Tabel HTML
                </a>
            </li>

            <!-- DATATABLES -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('modul-datatables') ? 'active' : '' }}"
                   href="/modul-datatables">
                    DataTables
                </a>
            </li>
             
            <!-- AJAX -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('modul-ajax') ? 'active' : '' }}"
                   href="{{ route('modul.ajax') }}">
                    AJAX Wilayah
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('modul.pos') }}">
                    POS (Kasir)
                </a>
            </li>
        
                </ul>
            </div>
        </li>

          <!-- SCAN BARCODE-->
        <li class="nav-item {{ request()->is('toko*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('toko.index') }}">
                <span class="menu-title">Geolocation</span>
                <i class="mdi mdi-tag menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->is('kunjungan') ? 'active' : '' }}">
            <a class="nav-link"
            href="/kunjungan">
                <span class="menu-title">
                    Kunjungan Toko
                </span>
                <i class="mdi mdi-qrcode-scan menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>