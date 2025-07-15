@extends('layouts.app')

@section('title', 'Tableau de bord Admin')

@section('content')

<div class="container py-4">
    <div class="text-center p-3 mb-3 rounded-4 shadow-lg" 
         style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
         
        <!-- PHOTO DE PROFIL -->
        @if(auth()->check())
            <img src="{{ auth()->user()->photo 
                ? asset('images/profils/' . auth()->user()->photo) 
                : asset('images/i9.png') }}" 
                alt="Photo de profil"
                class="rounded-circle shadow mb-3"
                width="80" height="80" style="object-fit: cover; overflow: hidden;  border-radius: 12px;  object-fit: cover;">
        @endif

        <div class="d-flex justify-content-center align-items-center mb-3">
            <h3 class="fw-bold text-dark mb-0">
                Bienvenue, {{ auth()->user()->prenom ?? 'Invité' }}
            </h3>
        </div>

        <p class="text-muted fs-5">Ravi de vous revoir sur votre espace Admin</p>

    </div>
</div>

{{-- 

<div class="container py-4">
    <div class="text-center mb-4">
       
        <div class="d-flex align-items-center justify-content-between mb-4">
    {{--   <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>--
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Tableau de bord</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>
 
        <h2 class="fw-bold"></h2>
        <p class="fs-5">Bienvenue, <strong>{{ Auth::user()->prenom }}</strong> !</p>
    </div>
 --}}
    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="bg-light border rounded p-3 shadow-sm" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                <h6 class="mb-1">Utilisateurs</h6>
                <span class="fs-4 text-primary">{{ $stats['total_utilisateurs'] }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-light border rounded p-3 shadow-sm" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                <h6 class="mb-1">Réservations totales</h6>
                <span class="fs-4 text-info">{{ $stats['total_reservations'] }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-light border rounded p-3 shadow-sm" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                <h6 class="mb-1">Aujourd’hui</h6>
                <span class="fs-4 text-success">{{ $stats['reservations_aujourd_hui'] }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-light border rounded p-3 shadow-sm" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                <h6 class="mb-1">Services actifs</h6>
                <span class="fs-4 text-warning">{{ $stats['services_actifs'] }}</span>
            </div>
        </div>
    </div>

    <h4 class="mb-3">📌 Réservations Récentes</h4>
    @if ($reservations_recentes->count())
        <ul class="list-group mb-4">
            @foreach ($reservations_recentes as $reservation)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $reservation->client->prenom }} - {{ $reservation->service->nom }} avec {{ $reservation->coiffeur->prenom }}
                    <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($reservation->date_heure_reservation)->format('d/m/Y H:i') }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">Aucune réservation récente.</div>
    @endif
    
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('services.index') }}" class="btn btn-outline-primary">📋 Gérer les Services</a>
        <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">Voir toutes les réservations</a>
        <a href="{{ route('admin.services.termines') }}" class="btn btn-outline-success">✅ les Services Terminés</a>
        <a href="{{ route('admin.coiffeurs.index') }}" class="btn btn-outline-secondary">👥 Gérer les coiffeurs</a>
        <a href="{{ route('admin.statistiques') }}" class="btn btn-outline-dark">📈 Voir les statistiques complètes</a>
        <a href="{{ route('promotions.index') }}" class="btn btn-outline-primary">Gérer les promotions</a>
    </div>
    
</div>

    <div class="row pt-5 mt-5 text-center">
   
   
  
  
  
  
    
  </div>
    </div>
@endsection



{{--  
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord Admin</h1>
    <p>Bienvenue, {{ Auth::user()->prenom }} !</p>

    <div class="row">
        <div class="col-md-3"><strong>Total utilisateurs:</strong> {{ $stats['total_utilisateurs'] }}</div>
        <div class="col-md-3"><strong>Total réservations:</strong> {{ $stats['total_reservations'] }}</div>
        <div class="col-md-3"><strong>Aujourd’hui:</strong> {{ $stats['reservations_aujourd_hui'] }}</div>
        <div class="col-md-3"><strong>Services actifs:</strong> {{ $stats['services_actifs'] }}</div>
    </div>

    <h3 class="mt-4">Réservations récentes</h3>
    <ul>
        @foreach ($reservations_recentes as $reservation)
            <li>{{ $reservation->client->prenom }} - {{ $reservation->service->nom }} avec {{ $reservation->coiffeur->prenom }} ({{ $reservation->date_heure_reservation }})</li>
        @endforeach
    </ul>
</div>

@endsection
--}}