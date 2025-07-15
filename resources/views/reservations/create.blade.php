
@extends('layouts.app')

@section('title', 'Nouvelle Réservation')

@section('content')
<div class="container py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Nouvelle Réservation</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

    <h2 class="mb-4 fw-bold text-center"></h2>

    <form method="POST" action="{{ route('reservations.store') }}" class="card p-4 shadow-sm">
        @csrf
       
        {{-- Service (déjà sélectionné) --}}
<div class="mb-3">
    <label class="form-label">Service</label>
    <input type="text" class="form-control" value="{{ $service->nom_service }} - {{ $service->prix }} CFA / {{ $service->duree_minutes }} min" readonly>
    <input type="hidden" name="id_service" value="{{ $service->id_service }}">
</div>

        {{-- Service 
        <div class="mb-3">
            <label for="id_service" class="form-label">Service</label>
            <select class="form-select" name="id_service" required>
                <option value="">— Choisissez un service —</option>
                @foreach($services as $service)
                    <option value="{{ $service->id_service }}" {{ old('id_service') == $service->id_service ? 'selected' : '' }}>
                        {{ $service->nom_service }} - {{ $service->prix }} CFA / {{ $service->duree_minutes }} min
                    </option>
                @endforeach
            </select>
            @error('id_service') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        --}}
        {{-- Coiffeur --}}
        <div class="mb-3">
            <label for="id_utilisateur_coiffeur" class="form-label">Coiffeur</label>
            <select class="form-select" name="id_utilisateur_coiffeur" id="coiffeurSelect" required>
                <option value="">— Choisissez un coiffeur —</option>
                @foreach($coiffeurs as $coiffeur)
                    <option value="{{ $coiffeur->id_utilisateur }}" {{ old('id_utilisateur_coiffeur') == $coiffeur->id_utilisateur ? 'selected' : '' }}>
                        {{ $coiffeur->nom }}
                    </option>
                @endforeach
            </select>
            @error('id_utilisateur_coiffeur') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="dateInput" class="form-control" value="{{ old('date') }}" required>
            @error('date') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Heure disponible (chargée dynamiquement) --}}
        <div class="mb-3">
            <label for="heure" class="form-label">Heure disponible</label>
            <select name="date_heure_reservation" id="heureSelect" class="form-select" required>
                <option value="">— Choisissez une heure —</option>
            </select>
            @error('date_heure_reservation') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes (optionnel)</label>
            <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
            @error('notes') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Bouton --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-calendar-plus"></i> Réserver
            </button>
        </div>
    </form>
</div>

{{-- JS pour charger les heures disponibles dynamiquement --}}
<script>
    const coiffeurSelect = document.getElementById('coiffeurSelect');
    const dateInput = document.getElementById('dateInput');
    const heureSelect = document.getElementById('heureSelect');

    function chargerDisponibilites() {
        const coiffeurId = coiffeurSelect.value;
        const date = dateInput.value;

        if (coiffeurId && date) {
            fetch(`/disponibilites/${coiffeurId}/${date}`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur serveur");
                    return response.json();
                })
                .then(data => {
                    heureSelect.innerHTML = '<option value="">— Choisissez une heure —</option>';
                    data.forEach(heure => {
                        const option = document.createElement('option');
                        option.value = `${date}T${heure}`;
                        option.textContent = heure;
                        heureSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Erreur lors du chargement des heures :", error);
                    heureSelect.innerHTML = '<option value="">Aucune heure disponible</option>';
                });
        }
    }

    coiffeurSelect.addEventListener('change', chargerDisponibilites);
    dateInput.addEventListener('change', chargerDisponibilites);
</script>
@endsection



{{--  
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nouvelle Réservation</h1>

    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="mb-3">
            <label for="id_service" class="form-label">Service</label>
            <select class="form-select" name="id_service" required>
                <option value="">Choisissez un service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id_service }}" {{ old('id_service') == $service->id_service ? 'selected' : '' }}>
                        {{ $service->nom_service }} - {{ $service->prix }}CFA / {{ $service->duree_minutes }} min
                    </option>
                @endforeach
            </select>
            @error('id_service') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="id_utilisateur_coiffeur" class="form-label">Coiffeur</label>
            <select class="form-select" name="id_utilisateur_coiffeur"  id="coiffeurSelect"  required>
                <option value="">Choisissez un coiffeur</option>
                @foreach($coiffeurs as $coiffeur)
                    <option value="{{ $coiffeur->id_utilisateur }}" {{ old('id_utilisateur_coiffeur') == $coiffeur->id_utilisateur ? 'selected' : '' }}>
                        {{ $coiffeur->nom }}
                    </option>
                @endforeach
            </select>
            @error('id_utilisateur_coiffeur') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
   
      <!-- Sélection de la date -->
     <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input name ="date" type="date" id="dateInput" class="form-control" required>
    </div>
 
    <!-- Sélection de l'heure disponible -->
   <div class="mb-3">
        <label for="heure" class="form-label">Heure disponible</label>
        <select name="date_heure_reservation" id="heureSelect" class="form-select" required>
            <option value="">Choisissez une heure</option>

        </select>
    </div>    
 


        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
            @error('notes') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
</div>

<script>
    const coiffeurSelect = document.getElementById('coiffeurSelect');
    const dateInput = document.getElementById('dateInput');
    const heureSelect = document.getElementById('heureSelect');

    function chargerDisponibilites() {
        const coiffeurId = coiffeurSelect.value;
        const date = dateInput.value;

        if (coiffeurId && date) {
            fetch(`/disponibilites/${coiffeurId}/${date}`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur serveur");
                    return response.json();
                })
                .then(data => {
                    heureSelect.innerHTML = '<option value="">Choisissez une heure</option>';
                    data.forEach(heure => {
                        const option = document.createElement('option');
                        option.value = `${date}T${heure}`; // format complet pour datetime-local
                        option.textContent = heure;
                        heureSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Erreur lors du chargement des heures :", error);
                    heureSelect.innerHTML = '<option value="">Aucune heure disponible</option>';
                });
        }
    }

    coiffeurSelect.addEventListener('change', chargerDisponibilites);
    dateInput.addEventListener('change', chargerDisponibilites);
</script>


@endsection
--}}