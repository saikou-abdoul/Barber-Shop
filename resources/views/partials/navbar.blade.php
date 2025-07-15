<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom" id="mainNavbar">
    <div class="container">
       {{--  <a class="navbar-brand fw-bold d-flex align-items-center text-primary" href="{{ url('/') }}">
            <i class="bi bi-scissors me-2 fs-4"></i> <span style="font-size: 1.4rem;">SalOOn</span>
        </a>--}} 
         <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
             <i class="bi bi-scissors me-2 fs-4"></i>
             <span style="font-size: 1.6rem;">Sal<span class="text-white">OOn</span></span>
         </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    {{-- Lien dashboard selon rôle --}}
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold position-relative" href="{{ url('/admin/dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Admin
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3+
                                </span>
                            </a>
                        </li>
                    @elseif(Auth::user()->isCoiffeur())
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold position-relative" href="{{ route('coiffeur.dashboard') }}">
                                <i class="bi bi-person-badge me-1"></i> Coiffeur
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    1
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold" href="{{ route('client.home') }}">
                                <i class="bi bi-house-door me-1"></i> Accueil
                            </a>
                        </li>
                    @endif
                    {{-- Profil --}}
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profilModal">
                       <i class="bi bi-person-circle me-1"></i> Mon Profil
                    </a>
                    
                    
                    

                    {{-- Déconnexion --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger ms-2">
                                <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                 
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i> Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
{{--  --}}
@if(Auth::check() && Auth::user()->isClient())
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero-slide" style="background-image: url('{{ asset('images/i1.png') }}');">
                <div class="overlay"></div>
                <div class="content text-white text-start">
                   <h1 class="display-5 fw-bold">Bienvenue {{ auth()->user()->prenom }} </h1>  
                    <p class="lead">Découvrez nos services tendance et réservez votre style</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero-slide" style="background-image: url('{{ asset('images/i2.png') }}');">
                <div class="overlay"></div>
                <div class="content text-white text-start">
                    <h1 class="display-5 fw-bold">Lookbook Élégance</h1>
                    <p class="lead">Pour homme, femme et enfants</p>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="carousel-item">
            <div class="hero-slide" style="background-image: url('{{ asset('images/i4.png') }}');">
                <div class="overlay"></div>
                <div class="content text-white text-start">
                    <h1 class="display-5 fw-bold">Trouvez votre style</h1>
                    <p class="lead">Une expérience unique à chaque visite</p>
                </div>
            </div>
        </div>
    </div>{{--  
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>--}}
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
</div>

<style>
.hero-slide {
    height: 40vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 5%;
    filter: brightness(1.1) contrast(1.05) saturate(1.05);
    transition: background-image 0.5s ease-in-out;
}
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(0, 0, 0, 0.35);
    z-index: 1;
    backdrop-filter: blur(1px);
}
.content {
    z-index: 2;
    max-width: 600px;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
}
.carousel-indicators button {
    background-color: #fff;
}
</style>

<style>
@media (prefers-color-scheme: dark) {
    .navbar {
        background-color: #222 !important;
        color: #fff !important;
    }

    .navbar .nav-link,
    .navbar .navbar-brand {
        color: #eee !important;
    }

    .navbar .nav-link:hover {
        color: #0d6efd !important;
    }

    .btn-outline-danger {
        border-color: #f66 !important;
        color: #f66 !important;
    }

    .btn-outline-danger:hover {
        background-color: #f66 !important;
        color: white !important;
    }
}
</style>

<style>
/* Force l'icône hamburger en blanc */
.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    background-size: 100% 100%;
}
</style>


@endif

{{--  
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center text-primary" href="{{ url('/') }}">
            <i class="bi bi-scissors me-2 fs-4"></i> <span style="font-size: 1.4rem;">SalOOn</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    {{-- Lien dashboard selon rôle 
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold position-relative" href="{{ url('/admin/dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Admin
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3+
                                </span>
                            </a>
                        </li>
                    @elseif(Auth::user()->isCoiffeur())
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold position-relative" href="{{ route('coiffeur.dashboard') }}">
                                <i class="bi bi-person-badge me-1"></i> Coiffeur
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    1
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold" href="{{ route('client.home') }}">
                                <i class="bi bi-house-door me-1"></i> Accueil
                            </a>
                        </li>
                    @endif

                    {{-- Déconnexion 
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger ms-2">
                                <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                            </button>
                        </form>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i> Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero-slide" style="background-image: url('{{ asset('images/image5.png') }}');">
                <div class="overlay"></div>
                <div class="content text-white text-start">
                    <h1 class="display-3 fw-bold">Bienvenue {{ auth()->user()->prenom }} </h1>
                    <p class="lead">Découvrez nos services tendance et réservez votre style</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero-slide" style="background-image: url('{{ asset('images/i2.png') }}');">
                <div class="overlay"></div>
                <div class="content text-white text-start">
                    <h1 class="display-3 fw-bold">Lookbook Élégance</h1>
                    <p class="lead">Pour homme, femme et enfants</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero-slide" style="background-image: url('{{ asset('images/i4.png') }}');">
                <div class="overlay"></div>
                <div class="content text-white text-start">
                    <h1 class="display-3 fw-bold">Trouvez votre style</h1>
                    <p class="lead">Une expérience unique à chaque visite</p>
                </div>
            </div>
        </div>
    </div>
  {{--    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button> 
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
</div>

<style>
.hero-slide {
    height: 40vh;
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 5%;
}
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}
.content {
    z-index: 2;
    max-width: 600px;
}
.carousel-indicators button {
    background-color: #fff;
}
</style>

<style>
@media (prefers-color-scheme: dark) {
    .navbar {
        background-color: #222 !important;
        color: #fff !important;
    }

    .navbar .nav-link,
    .navbar .navbar-brand {
        color: #eee !important;
    }

    .navbar .nav-link:hover {
        color: #0d6efd !important;
    }

    .btn-outline-danger {
        border-color: #f66 !important;
        color: #f66 !important;
    }

    .btn-outline-danger:hover {
        background-color: #f66 !important;
        color: white !important;
    }
}
</style>

--}}

{{-- 
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center text-primary" href="{{ url('/') }}">
            <i class="bi bi-scissors me-2 fs-4"></i> <span style="font-size: 1.4rem;">SalOOn</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    {{-- Lien dashboard selon rôle 
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold position-relative" href="{{ url('/admin/dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Admin
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3+
                                </span>
                            </a>
                        </li>
                    @elseif(Auth::user()->isCoiffeur())
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold position-relative" href="{{ route('coiffeur.dashboard') }}">
                                <i class="bi bi-person-badge me-1"></i> Coiffeur
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    1
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold" href="{{ route('client.home') }}">
                                <i class="bi bi-house-door me-1"></i> Accueil
                            </a>
                        </li>
                    @endif

                    {{-- Déconnexion 
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger ms-2">
                                <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                            </button>
                        </form>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i> Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
@media (prefers-color-scheme: dark) {
    .navbar {
        background-color: #222 !important;
        color: #fff !important;
    }

    .navbar .nav-link,
    .navbar .navbar-brand {
        color: #eee !important;
    }

    .navbar .nav-link:hover {
        color: #0d6efd !important;
    }

    .btn-outline-danger {
        border-color: #f66 !important;
        color: #f66 !important;
    }

    .btn-outline-danger:hover {
        background-color: #f66 !important;
        color: white !important;
    }
}
</style>

 --}}
{{--  

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top" id="mainNavbar">

    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            <i class="bi bi-scissors"></i> SalOOn
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                 {{-- Lien tableau de bord selon rôle 
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Admin
                            </a>
                        </li>
                    @elseif(Auth::user()->isCoiffeur())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('coiffeur.dashboard') }}">
                                <i class="bi bi-person-badge"></i> Coiffeur
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.home') }}">
                                <i class="bi bi-house"></i> Accueil
                            </a>
                        </li>
                    @endif

                    {{-- Bouton Déconnexion 
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-link">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                @else
                    {{-- Visiteurs non connectés 
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


--}}
{{--  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">SalOOn</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                  @if(Auth::user()->isAdmin())
                    <li class="nav-item"><a class="nav-link" href="{{ url('/admin/dashboard') }}">Tableau Admin</a></li>@endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">@csrf
                            <button class="btn btn-link nav-link">Déconnexion</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Inscription</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
--}}