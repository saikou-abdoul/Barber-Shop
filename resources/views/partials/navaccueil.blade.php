

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

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-uppercase fw-semibold">
                <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="#a-propos">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#equipe">Equipe</a></li>
                <li class="nav-item"><a class="nav-link" href="#tarif">Tarif</a></li>
                <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>

            <!-- Connexion / Inscription -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary ms-2 fw-semibold" href="{{ route('register') }}">
                        <i class="bi bi-person-plus me-1"></i> Inscription
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>