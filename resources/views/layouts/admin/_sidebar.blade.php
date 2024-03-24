<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if(Route::has('admin.dashboard'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @endif

        <li class="nav-heading">{{ __('ADMINISTRATION') }}</li>

        @if(Route::has('admin.roles.index'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.roles.index') }}">
                    <i class="bi bi-file-ruled"></i>
                    <span>{{ __('Roles') }}</span>
                </a>
            </li><!-- Fin Role Nav -->
        @endif

        @if(Route::has('admin.categories.index'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-journal-richtext"></i>
                    <span>{{ __('Catégories') }}</span>
                </a>
            </li><!-- Fin Catégories Nav -->
        @endif

        <li class="nav-heading">{{ __('GESTION') }}</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-bookmark"></i>
                <span>{{ __('Véhicules') }}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @if(Route::has('admin.vehicules.index'))
                    <li>
                        <a href="{{ route('admin.vehicules.index') }}">
                            <i class="bi bi-car-front"></i><span>{{ __('Liste des véhicules') }}</span>
                        </a>
                    </li>
                @endif

                @if(Route::has('admin.vehicules.create'))
                    <li>
                        <a href="{{ route('admin.vehicules.create') }}">
                            <i class="bi bi-plus-circle-dotted"></i><span>{{ __('Ajouter un véhicules') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li><!-- End Vehicle Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-badge"></i>
                <span>{{ __('Chauffeurs') }}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @if(Route::has('admin.chauffeurs.index'))
                <li>
                    <a href="{{ route('admin.chauffeurs.index') }}">
                        <i class="bi bi-circle"></i><span>{{ __('Liste des Chauffeurs') }}</span>
                    </a>
                </li>
                @endif

                @if(Route::has('admin.chauffeurs.create'))
                <li>
                    <a href="{{ route('admin.chauffeurs.create') }}">
                        <i class="bi bi-circle"></i><span>{{ __('Ajouter un Chauffeur') }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </li><!-- End Chauffeurs Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-rolodex"></i>
                <span>{{ __('Clients') }}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                @if(Route::has('admin.clients.index'))
                    <li>
                        <a href="{{ route('admin.clients.index') }}">
                            <i class="bi bi-circle"></i><span>{{ __('Liste des Clients') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li><!-- End Clients Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#transactions-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-rolodex"></i>
                <span>{{ __('Transactions') }}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="transactions-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                @if(Route::has('admin.payements.index'))
                    <li>
                        <a href="{{ route('admin.payements.index') }}">
                            <i class="bi bi-circle"></i><span>{{ __('Liste des transactions') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li><!-- End Transaction Nav -->

        <li class="nav-heading">{{ __('Utilisateurs') }}</li>

        @if(Route::has('admin.users.index'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i>
                <span>Tous les utilisateurs</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @endif

        @if(Route::has('admin.users.show'))
        <li class="nav-item">
            <a class="nav-link collapsed"
               href="{{ route('admin.users.show', Auth::user()->id) }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @endif

        @guest
            @if(Route::has('login'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>
            </li><!-- End Login Page Nav -->
            @endif
        @endguest

        @auth
        <li class="nav-item" >
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link collapsed"
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>{{ __('Logout') }}</span>
                </button>
            </form>
        </li><!-- End Login Page Nav -->
        @endauth


    </ul>

</aside>
