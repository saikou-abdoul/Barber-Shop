@extends('layouts.app')

@section('title', 'Détails de la Réservation')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Détails de la Réservation</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

    <h2 class="mb-4 fw-bold text-center"></h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Service :</strong> {{ $reservation->service->nom_service ?? '—' }}</li>
                <li class="list-group-item"><strong>Coiffeur :</strong> {{ $reservation->coiffeur->nom ?? '—' }}</li>
               @auth
                 @if(Auth::user()->isCoiffeur())
                <li class="list-group-item"><strong>Client :</strong> {{ $reservation->client->nom ?? '—' }}</li>
                   @endif
                @endauth
                <li class="list-group-item"><strong>Date & Heure :</strong> {{ $reservation->date_heure_reservation->format('d/m/Y H:i') }}</li>
                <li class="list-group-item"><strong>Statut :</strong> 
                    <span class="badge bg-{{ $reservation->statut === 'confirmé' ? 'success' : ($reservation->statut === 'annulé' ? 'danger' : 'secondary') }}">
                        {{ ucfirst($reservation->statut) }}
                    </span>
                </li>
                <li class="list-group-item"><strong>Notes :</strong> {{ $reservation->notes ?? '—' }}</li>
            </ul>

            {{-- Bouton d’annulation pour le client --}}
            @if(auth()->user()->isClient() && $reservation->id_utilisateur_client === auth()->user()->id_utilisateur && $reservation->statut === 'en_attente')
                <form action="{{ route('reservations.annuler', $reservation) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous vraiment annuler cette réservation ?')">
                        <i class="bi bi-x-circle"></i> Annuler la réservation
                    </button>
                </form>
            @endif

            {{-- Formulaire de mise à jour du statut (admin ou coiffeur) --}}
            @if(auth()->user()->isCoiffeur() || auth()->user()->isAdmin())
                <form method="POST" action="{{ route('reservations.updateStatus', $reservation) }}" class="mt-4">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="statut" class="form-label">Modifier le statut :</label>
                        <select name="statut" class="form-select">
                            <option value="en_attente" {{ $reservation->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmé" {{ $reservation->statut == 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                            <option value="annulé" {{ $reservation->statut == 'annulé' ? 'selected' : '' }}>Annulé</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-arrow-repeat"></i> Mettre à jour le statut
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection



{{--  

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de la Réservation</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Service :</strong> {{ $reservation->service->nom_service ?? '—' }}</p>
            <p><strong>Coiffeur :</strong> {{ $reservation->coiffeur->nom ?? '—' }}</p>
            <p><strong>Client :</strong> {{ $reservation->client->nom ?? '—' }}</p>
            <p><strong>Date & Heure :</strong> {{ $reservation->date_heure_reservation->format('d/m/Y H:i') }}</p>
            <p><strong>Statut :</strong> {{ ucfirst($reservation->statut) }}</p>
            <p><strong>Notes :</strong> {{ $reservation->notes ?? '—' }}</p>
   
            @if(auth()->user()->isClient() && $reservation->id_utilisateur_client === auth()->user()->id_utilisateur && $reservation->statut === 'en_attente')
            <form action="{{ route('reservations.annuler', $reservation) }}" method="POST" class="d-inline">
             @csrf
             @method('PATCH')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment annuler cette réservation ?')">
                Annuler
              </button>
         </form>
          @endif
            @if(auth()->user()->isCoiffeur() || auth()->user()->isAdmin())
                <form method="POST" action="{{ route('reservations.updateStatus', $reservation) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mt-3">
                        <label for="statut">Changer le statut :</label>
                        <select name="statut" class="form-select">
                            <option value="en_attente" {{ $reservation->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmé" {{ $reservation->statut == 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                            <option value="annulé" {{ $reservation->statut == 'annulé' ? 'selected' : '' }}>Annulé</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Mettre à jour</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
--}}