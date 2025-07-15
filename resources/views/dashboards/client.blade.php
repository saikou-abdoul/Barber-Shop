

@extends('layouts.app')

@section('title', 'Tableau de bord Client')

@section('content')

<div class="container my-5">
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

        <p class="text-muted fs-5">Ravi de vous revoir sur votre espace</p>

    </div>
</div>
{{--  
<div class="container py-4">
    <div class="text-center mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Tableau de bord</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

        <h2 class="fw-bold"></h2>
        <p class="fs-5">Bienvenue, <strong>{{ Auth::user()->prenom }}</strong> !</p>
    </div>
--}}
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="bg-light border rounded p-3 shadow-sm" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                <h5 class="mb-1">Total Réservations</h5>
                <span class="fs-4 text-primary">{{ $stats['total_reservations'] }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-light border rounded p-3 shadow-sm" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                <h5 class="mb-1">Confirmées</h5>
                <span class="fs-4 text-success">{{ $stats['reservations_confirmees'] }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-light border rounded p-3 shadow-sm" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                <h5 class="mb-1">En Attente</h5>
                <span class="fs-4 text-warning">{{ $stats['reservations_en_attente'] }}</span>
            </div>
        </div>
    </div>

    <h4 class="mb-3">📅 Prochaines Réservations</h4>
    <div style="width: 40px;"></div>
    @if ($prochaines_reservations->count())
        <ul class="list-group mb-4">
            @foreach ($prochaines_reservations as $reservation)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $reservation->service->nom }} avec {{ $reservation->coiffeur->prenom }}
                    <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($reservation->date_heure_reservation)->format('d/m/Y H:i') }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">Aucune réservation à venir.</div>
    @endif
    {{-- 
    <div class="row pt-5 mt-5 text-center">
    <div class="col-md-12">
    <div class="border-top pt-5">
         <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 Copyright &copy;<script>document.write(new Date().getFullYear());</script> SalOOn - Tous droits réservés
               <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
         </p>
    </div>
  </div> --}}
{{--  
    <div class="d-flex justify-content-center gap-3">
       
        <a href="{{ route('reservations.create') }}" class="btn btn-success">🗓️ Réserver</a>
        <a href="{{ route('reservations.index') }}" class="btn btn-info text-white">📋 Mes Réservations</a>
    </div>
</div>
--}}
@endsection



{{--  
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord Client</h1>
    <p>Bienvenue, {{ Auth::user()->prenom }} !</p>

    <div class="row">
        <div class="col-md-4"><strong>Total réservations:</strong> {{ $stats['total_reservations'] }}</div>
        <div class="col-md-4"><strong>Confirmées:</strong> {{ $stats['reservations_confirmees'] }}</div>
        <div class="col-md-4"><strong>En attente:</strong> {{ $stats['reservations_en_attente'] }}</div>
    </div>

    <h3 class="mt-4">Prochaines réservations</h3>
    <ul>
        @foreach ($prochaines_reservations as $reservation)
            <li>{{ $reservation->service->nom }} avec {{ $reservation->coiffeur->prenom }} le {{ $reservation->date_heure_reservation }}</li>
        @endforeach
    </ul>
</div>
@endsection
--}}