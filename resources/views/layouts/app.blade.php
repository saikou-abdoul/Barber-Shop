<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Salon')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-sA+e2FWq5y3yU1je1aZO5kdqU5gZ0pNRFOWDGkxE3pU=" crossorigin=""/>
@endpush

 {{-- 🔁 Preloader global --}}
    @include('partials.preloader')

    @yield('custom-style') <!-- Permet d'ajouter un style spécifique dans certaines pages -->

@section('custom-style')
<style>
    .navbar.sticky-top {
        z-index: 1030;
        transition: all 0.3s ease-in-out;
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
    }

    .navbar.scrolled {
        background-color: rgba(255, 255, 255, 1) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

    {{--  @section('custom-style')
<style>
    .navbar.sticky-top {
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.9);
        transition: background-color 0.3s ease-in-out;
        z-index: 1030; /* au-dessus du carrousel */
    }
</style>
@endsection
--}}
@push('styles')


<style>
.pagination {
    font-size: 0.75rem;
}
.page-item .page-link {
    padding: 0.3rem 0.10rem;
    min-width: 20px;
    border-radius: 6px;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    transition: all 0.2s ease;
}
.page-item.active .page-link {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
.page-item .page-link:hover {
    background-color: #e9ecef;
    color: #0d6efd;
}

img[ data-bs-toggle="modal" ]:hover {
    transform: scale(1.05);
    transition: 0.2s ease-in-out;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}


</style>
@endpush

<style>
    .category-card:hover {
        transform: translateY(-5px);
    }

    .category-overlay {
        text-align: center;
    }
</style>


</head>
<body>
{{-- 
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
 --}}
    @include('partials.navtotal')
    <div class="container mt-4">
        @yield('content')
    </div>

@auth
    @php $user = Auth::user(); @endphp
{{--  
    @if ($user->isAdmin())
        <!-- Menu admin -->
        <a href="{{ route('services.index') }}">Services du salon</a>
        <a href="{{ route('admin.services.termines') }}">Les Services Terminés</a>       --}}
    @if ($user->isCoiffeur())
        <!-- Menu coiffeur -->
        <a href="{{ route('services.index') }}">Services</a>
        <a href="{{ route('coiffeur.dashboard') }}">Tableau Coiffeur</a>
        <a href="{{ route('reservations.index') }}">Consulter Réservations</a>
        <a href="{{ route('disponibilites.index') }}">Mes disponibilités</a>
        @elseif ($user->isClient())
        <!-- Menu client -->
     {{--     <a href="{{ route('client.dashboard') }}">Tableau de bord</a>
        <a href="{{ route('reservations.create') }}">Réserver</a>
        <a href="{{ route('reservations.index') }}">Mes Réservations</a>
    --}} 
        @endif
@endauth


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-vM7lV7rRZNoFCIgdso6H+liP+aJ4RCBaexvJw28O+j0=" crossorigin=""></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const map = L.map('map', {
            zoomControl: false,
            scrollWheelZoom: false,
            dragging: true
        }).setView([14.6928, -17.4467], 13);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        const marker = L.marker([14.6928, -17.4467]).addTo(map);
        marker.bindPopup("Nous sommes ici !").openPopup();
    });
</script>
@endpush

 {{-- 🔁 Script du preloader --}}
    <script>
        window.addEventListener("load", function () {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.style.opacity = '0';
                preloader.style.visibility = 'hidden';
            }, 2000);
        });
    </script>

@include('components.modal-profil')


<footer class="bg-dark text-white pt-5 pb-4" id="contact">
    <div class="container text-md-start">
        <div class="row">
            <!-- À propos -->
              <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
               <i class="bi bi-scissors me-2 fs-4"></i>
                <span style="font-size: 1.6rem;">Sal<span class="text-white">OOn</span></span>
              </a>
            <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
                <p>Salon de coiffure moderne à votre service pour révéler votre style. Une équipe passionnée et professionnelle à Dakar.</p>
            </div>
           
            <!-- Liens utiles -->
            <div class="col-md-2 col-lg-2 col-xl-2 mb-4"> {{-- 
                <h6 class="text-uppercase fw-semibold mb-3">Navigation</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Accueil</a></li>
                    <li><a href="#a-propos" class="text-white text-decoration-none">À propos</a></li>
                    <li><a href="#services" class="text-white text-decoration-none">Services</a></li>
                    <li><a href="#equipe" class="text-white text-decoration-none">Equipe</a></li>
                    <li><a href="#tarif" class="text-white text-decoration-none">Tarift</a></li>
                    <li><a href="#portfolio" class="text-white text-decoration-none">Portfolio</a></li>
                    <li><a href="#contact" class="text-white text-decoration-none">Contact</a></li>
                </ul> --}}
            </div>
            
            <!-- Horaires -->
            <div class="col-md-3 col-lg-3 col-xl-3 mb-4">
                <h6 class="text-uppercase fw-semibold mb-3">Horaires</h6>
                <p>Lundi - Dimanche : 9h00 - 22h00</p>
                <p>Vendredi : 15h00 - 22h00</p>
            </div>

            <!-- Contact et réseaux -->
            <div class="col-md-4 col-lg-3 col-xl-3 mb-md-0 mb-4">
                <h6 class="text-uppercase fw-semibold mb-3">Contact</h6>
                <p><i class="bi bi-geo-alt me-2"></i> Plateau, Dakar</p>
                <p><i class="bi bi-telephone me-2"></i> +221 77 123 45 67</p>
                <p><i class="bi bi-envelope me-2"></i> contact@saloon.sn</p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-whatsapp fs-5"></i></a>
                </div>
            </div>
        </div>

        <!-- Ligne du bas -->
        <hr class="mb-4">
        <div class="text-center">
            <p class="mb-0">&copy; 2025 SalOOn - Tous droits réservés</p>
        </div>
    </div>
</footer>



</body>
</html>
