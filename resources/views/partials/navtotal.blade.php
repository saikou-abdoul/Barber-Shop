

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom py-3">
    <div class="container" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
          <i class="bi bi-scissors me-2 fs-4"></i>
          <span style="font-size: 1.6rem;">Sal<span class="text-dark">OOn</span></span>
        </a>
        <!-- Burger Menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
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
                  {{--   <a class="nav-link" href="{{ route('client.profil') }}">
                    <i class="bi bi-person-circle me-1"></i> Mon Profil
                     </a>--}} 
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


