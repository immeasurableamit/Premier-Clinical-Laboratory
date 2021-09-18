<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#"><img src="{{ asset('assets/logos/favicon.png') }}" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('assets/logos/favicon.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
  <span class="icon-menu"></span>
</button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="ti-user mx-0"></i>

                    <b>{{ session::get('name') }}</b>
                </a>

            </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @if (session('role') == 2)
                    <img src="{{ asset('assets/logos/favicon.png') }}" alt="profile" />
                    @else
                     <img src="{{ asset('assets/logos/favicon.png') }}" alt="profile" />
                    @endif

                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">


                    <a href="{{ route('admin.pass.view') }}" class="dropdown-item">
                        <i class="ti-lock text-primary"></i> Change password
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="ti-power-off text-primary"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
  <span class="icon-menu"></span>
</button>
    </div>
</nav>
