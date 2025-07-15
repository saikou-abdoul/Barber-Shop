@extends('layouts.app')

@section('title', 'Tableau de bord Coiffeur')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Tableau de bord Coiffeur</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

        <h2 class="fw-bold"></h2>
        <p class="fs-5">Bienvenue, <strong>{{ Auth::user()->prenom }}</strong> !</p>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="bg-light border rounded p-3 shadow-sm">
                <h6 class="mb-1">Réservations totales</h6>
                <span class="fs-4 text-primary">{{ $stats['total_reservations'] }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-light border rounded p-3 shadow-sm">
                <h6 class="mb-1">Aujourd’hui</h6>
                <span class="fs-4 text-success">{{ $stats['reservations_aujourd_hui'] }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-light border rounded p-3 shadow-sm">
                <h6 class="mb-1">En attente</h6>
                <span class="fs-4 text-warning">{{ $stats['reservations_en_attente'] }}</span>
            </div>
        </div>
    </div>

    <h4 class="mb-3">🗓️ Planning du jour</h4>
    @if ($planning_jour->count())
        <ul class="list-group mb-4">
            @foreach ($planning_jour as $reservation)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $reservation->client->prenom }} - {{ $reservation->service->nom }}
                    <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($reservation->date_heure_reservation)->format('H:i') }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">Aucune réservation aujourd’hui.</div>
    @endif

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('reservations.index') }}" class="btn btn-outline-primary">📋 Voir Réservations</a>
        <a href="{{ route('disponibilites.index') }}" class="btn btn-outline-success">🕒 Mes Disponibilités</a>
    </div>
</div>

    <div class="row pt-5 mt-5 text-center">
    <div class="col-md-12">
    <div class="border-top pt-5">
         <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 Copyright &copy;<script>document.write(new Date().getFullYear());</script> SalOOn - Tous droits réservés
               <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
         </p>
    </div>
  </div>
@endsection





{{--  

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord Coiffeur</h1>
    <p>Bienvenue, {{ Auth::user()->prenom }} !</p>

    <div class="row">
        <div class="col-md-4"><strong>Total réservations:</strong> {{ $stats['total_reservations'] }}</div>
        <div class="col-md-4"><strong>Aujourd’hui:</strong> {{ $stats['reservations_aujourd_hui'] }}</div>
        <div class="col-md-4"><strong>En attente:</strong> {{ $stats['reservations_en_attente'] }}</div>
    </div>

    <h3 class="mt-4">Planning du jour</h3>
    <ul>
        @foreach ($planning_jour as $reservation)
            <li>{{ $reservation->client->prenom }} - {{ $reservation->service->nom }} à {{ $reservation->date_heure_reservation }}</li>
        @endforeach
    </ul>
</div>
@endsection

  --}}