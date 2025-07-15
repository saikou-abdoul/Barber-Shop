@extends('layouts.app')

@section('title', 'Accueil Client')

@section('content')
<!-- Feuilles de style Leaflet (carte) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<!-- Lightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet">
<!-- Lightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>

<style>
    .category-card {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
        transition: transform 0.3s ease;
        height: 200px;
    }
    .category-card:hover {
        transform: scale(1.03);
    }
    .category-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-weight: bold;
        font-size: 1.25rem;
        text-align: center;
        padding: 0.5rem;
    }
</style>

<div class="container py-3">
    <div class="text-center p-4 mb-4 rounded-4 shadow-lg" 
         style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
    
    @if(auth()->check())
<div class="dropdown">
    <a href="#" class="d-inline-block" role="button" id="photoDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ auth()->user()->photo 
            ? asset('images/profils/' . auth()->user()->photo) 
            : asset('images/i9.png') }}" 
            alt="Photo de profil"
            class="rounded-circle shadow"
            width="80" height="80"
            style="object-fit: cover; border-radius: 12px; cursor: pointer;">
    </a>

    <ul class="dropdown-menu text-center" aria-labelledby="photoDropdown"  style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
        @if(auth()->user()->photo)
        <li>
            <a href="{{ asset('images/profils/' . auth()->user()->photo) }}" 
               data-lightbox="photo-profil" 
               data-title="Photo de {{ auth()->user()->prenom }}" 
               class="dropdown-item">
               📷 Voir ma photo
            </a>
        </li>
        @endif
        <li>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profilModal">
           {{--  <a href="{{ route('client.profil.update', auth()->user()->id) }}" class="dropdown-item"> --}}
                <i class="bi bi-person-circle me-1"></i> Voir mon profil
            </a>
        </li>
    </ul>
</div>
@endif


         {{--    
        <!-- PHOTO DE PROFIL -->
        @if(auth()->check())
            <img src="{{ auth()->user()->photo 
                ? asset('images/profils/' . auth()->user()->photo) 
                : asset('images/i9.png') }}" 
                alt="Photo de profil"
                class="rounded-circle shadow mb-3"
                width="80" height="80" style="object-fit: cover; overflow: hidden;  border-radius: 12px;  object-fit: cover;"
                 data-bs-toggle="modal" data-bs-target="#profilModal">
        @endif
--}} 
        <div class="d-flex justify-content-center align-items-center mb-3">
            <h3 class="fw-bold text-dark mb-0">
                Bienvenue, {{ auth()->user()->prenom ?? 'Invité' }}
            </h3>
        </div>

        <p class="text-muted fs-5">Ravi de vous revoir sur votre espace client</p>

    </div>
</div>



{{--  
<div class="container py-4">
    <div class="text-center p-5 mb-5 rounded-4 shadow-lg" 
         style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
         
        <div class="d-flex justify-content-center align-items-center mb-3">
            
            <h3 class="fw-bold text-dark mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-icon lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg> Bienvenue, {{ Auth::user()->prenom }}</h3>
        </div>

        <p class="text-muted fs-5">Ravi de vous revoir sur votre espace client</p>

        <div class="mt-3">
            <span class="badge bg-primary text-white px-4 py-2 fs-6 shadow-sm rounded-pill">
                📅 Année : 2024 / 2025
            </span>
        </div>
    </div>
</div>
--}}
{{-- 
< class="container py-4">
    <div class="text-center shadow rounded p-4 mb-5 bg-white">
        <h4 class="text-dark fw-bold">Bienvenue : {{ Auth::user()->prenom }}</h4>
        <div class="mt-2">
            <span class="badge bg-light text-primary border border-primary px-4 py-2 fs-5">
                📅 Année : 2024/2025
            </span>
        </div>
    </div>
 --}}
 
    <h2 class="text-center fw-bold mb-4">Menu</h2>
    <div class="row g-3">
        @php
            $cards = [
                ['route' => 'fidelite.index', 'img' => 'images/i5.png', 'text' => 'Mes remises'],
                ['route' => 'avis.index', 'img' => 'images/i7.jpeg', 'text' => 'Votre Avis'],
                ['route' => 'pub.index', 'img' => 'images/i6.jpeg', 'text' => 'Actus'],
                ['route' => 'reservations.index', 'img' => 'images/image11.png', 'text' => 'Mes réservations'],
                ['route' => 'client.services', 'img' => 'images/image9.png', 'text' => 'Nos services'],
                ['route' => 'client.dashboard', 'img' => 'images/image8.png', 'text' => 'Tableau de bord'],
            ];
        @endphp
{{-- 
@foreach ($cards as $card)
    <div class="col-md-4 col-sm-6 mb-4">
        <a href="{{ route($card['route']) }}" class="text-decoration-none">
            <div class="category-card shadow rounded overflow-hidden position-relative"
                 style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd; transition: transform 0.3s;">
                
                <!-- Image intacte -->
                <img src="{{ asset($card['img']) }}" alt="{{ $card['text'] }}" class="img-fluid rounded mb-3">

                <!-- Texte -->
                <div class="category-overlay text-dark fw-bold fs-5">
                    {{ $card['text'] }}
                </div>
            </div>
        </a>
    </div>
@endforeach
 --}}     
        @foreach ($cards as $card)
        <div class="col-md-4 col-sm-6">
            <a href="{{ route($card['route']) }}" class="text-decoration-none">
                <div class="category-card shadow">
                    <img src="{{ asset($card['img']) }}" alt="{{ $card['text'] }}">
                    <div class="category-overlay">{{ $card['text'] }}</div>
                </div>
            </a>
        </div>
        @endforeach 
    </div>
</div>

<section  class="py-5 position-relative">
<div class="container mt-5">
    <h3 class="text-center fw-bold">Notre Emplacement</h3>
    <div id="map" style="height: 150px; width: 100%; border-radius: 12px; margin-top: 1rem;"></div>
</div>
</section>

{{--  
<div class="text-center mt-5 pt-5 border-top">
    <p>
        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
        SalOOn - Tous droits réservés
    </p>
</div>
--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map').setView([14.6928, -17.4467], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        L.marker([14.6928, -17.4467]).addTo(map)
            .bindPopup("Nous sommes ici !").openPopup();
    });
</script>


@endsection
