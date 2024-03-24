<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="{{ Auth::user()->getAvatar() }}" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2">
                    {{ strtoupper(Auth::user()->nom[0]) }}. {{ Auth::user()->prenom }}
                </span>
            </a><!-- End Profile Image Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>{{ Auth::user()->prenom }}</h6>
                    <span>{{ Auth::user()->email }}</span>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                @if(Route::has('admin.users.show'))
                <li>
                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ route('admin.users.show', Auth::user()) }}">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                </li>

                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>

                @if(Route::has('admin.users.show'))
                <li>
                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ route('admin.users.show', Auth::user()) }}">
                        <i class="bi bi-gear"></i>
                        <span>Account Settings</span>
                    </a>
                </li>
                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>{{ __('Log Out') }}</span>
                        </button>
                    </form>

                </li>

            </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

    </ul>
</nav><!-- End Icons Navigation -->
