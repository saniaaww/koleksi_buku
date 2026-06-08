<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
            <img src="{{ asset('template/assets/images/logo.svg') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <img src="{{ asset('template/assets/images/logo-mini.svg') }}" alt="logo" />
        </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

            <!-- PROFILE DROPDOWN -->
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                    <div class="nav-profile-img">
                        <img src="{{ Auth::check() 
    ? asset('template/assets/images/faces/sania.png') 
    : asset('template/assets/images/faces/face1.jpg') }}"
     class="img-circle elevation-2"
     style="width:35px; height:35px; object-fit:cover;"
     alt="User Image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">
                            {{ Auth::user()->name ?? 'User' }}
                        </p>
                    </div>
                </a>

                <div class="dropdown-menu navbar-dropdown dropdown-menu-end">
                    
                    <a class="dropdown-item" href="#">
                        <i class="mdi mdi-account me-2 text-success"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                        </button>
                    </form>

                </div>
            </li>

        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>

    </div>
</nav>