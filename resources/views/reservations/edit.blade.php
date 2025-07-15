
@extends('layouts.app')

@section('title', 'Modifier la Réservation')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Modifier la Réservation</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

    <h2 class="mb-4 fw-bold text-center"></h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reservations.update.client', $reservation) }}" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        {{-- Service --}}
        <div class="mb-3">
            <label for="id_service" class="form-label">Service</label>
            <select name="id_service" id="id_service" class="form-select" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id_service }}" {{ $service->id_service == $reservation->id_service ? 'selected' : '' }}>
                        {{ $service->nom_service }} - {{ $service->prix }} CFA
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Coiffeur --}}
        <div class="mb-3">
            <label for="id_utilisateur_coiffeur" class="form-label">Coiffeur</label>
            <select name="id_utilisateur_coiffeur" id="id_utilisateur_coiffeur" class="form-select" required>
                @foreach ($coiffeurs as $coiffeur)
                    <option value="{{ $coiffeur->id_utilisateur }}" {{ $coiffeur->id_utilisateur == $reservation->id_utilisateur_coiffeur ? 'selected' : '' }}>
                        {{ $coiffeur->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date & Heure --}}
        <div class="mb-3">
            <label for="date_heure_reservation" class="form-label">Date & Heure</label>
            <input 
                type="datetime-local" 
                name="date_heure_reservation" 
                class="form-control" 
                value="{{ $reservation->date_heure_reservation->format('Y-m-d\TH:i') }}" 
                required
            >
        </div>

        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $reservation->notes) }}</textarea>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Annuler
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection



{{--  

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la Réservation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reservations.update.client', $reservation) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_service" class="form-label">Service</label>
            <select name="id_service" id="id_service" class="form-control" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id_service }}" {{ $service->id_service == $reservation->id_service ? 'selected' : '' }}>
                        {{ $service->nom_service }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_utilisateur_coiffeur" class="form-label">Coiffeur</label>
            <select name="id_utilisateur_coiffeur" id="id_utilisateur_coiffeur" class="form-control" required>
                @foreach ($coiffeurs as $coiffeur)
                    <option value="{{ $coiffeur->id_utilisateur }}" {{ $coiffeur->id_utilisateur == $reservation->id_utilisateur_coiffeur ? 'selected' : '' }}>
                        {{ $coiffeur->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_heure_reservation" class="form-label">Date & Heure</label>
            <input type="datetime-local" name="date_heure_reservation" class="form-control" value="{{ $reservation->date_heure_reservation->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $reservation->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
--}}