<header class="site-navbar site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center position-relative">

            <div class="col-3">
                <div class="site-logo">
                    <a href="#"><strong>{{ config('app.name', "Yobalema") }}</strong></a>
                </div>
            </div>

            <div class="col-9  text-right">

                <span class="d-inline-block d-lg-none">
                    <a href="#" class=" site-menu-toggle js-menu-toggle py-5 ">
                        <span class="icon-menu h3 text-black"></span>
                    </a>
                </span>

                <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto ">
                        <li class="active"><a href="{{ route('accueil') }}" class="nav-link">Home</a></li>
                        @auth
                            @if(Auth::user()->role_id != 3)
                            <li><a href="{{ route('location.client.last', Auth::user()) }}" class="nav-link">
                                    Location Courante</a>
                            </li>
                            <li>
                                <a href="{{ route('location.client.all', Auth::user()) }}" class="nav-link">
                                    Toutes mes locations
                                </a>
                            </li>
                            @endif

                            @if(Auth::user()->role_id == 3)
                                <li>
                                    <a href="{{ route('location.chauffeur.last', Auth::user()) }}" class="nav-link">
                                        Location Courante
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('location.chauffeur.all', Auth::user()) }}" class="nav-link">
                                        Toutes mes courses
                                    </a>
                                </li>
                            @endif
                        @endauth
                        <li><a href="{{ route('home.vehicules') }}" class="nav-link">Services</a></li>
                        @auth
                            @if(Auth::user()->isAdmin())
                                <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="nav-link text-danger">Déconnexion</button>
                                </form>
                            </li>

                        @endauth
                        @guest
                            <li><a href="{{ route('login') }}" class="nav-link">Se connecter</a></li>
                            <li><a href="{{ route('register') }}" class="nav-link">S'inscrire</a></li>
                        @endguest
                    </ul>
                </nav>
            </div>


        </div>
    </div>

</header>
