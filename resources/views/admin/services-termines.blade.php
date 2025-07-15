@extends('layouts.app')

@section('content')
<div class="container mt-5">
              <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>

    <form method="GET" action="{{ route('admin.services.termines') }}" class="row g-3 mb-4">
    <div class="col-md-4">
        <label class="form-label">Filtrer par coiffeur :</label>
        <select name="coiffeur_id" class="form-select">
            <option value="">-- Tous les coiffeurs --</option>
            @foreach($coiffeurs as $coiffeur)
                <option value="{{ $coiffeur->id_utilisateur }}" {{ request('coiffeur_id') == $coiffeur->id_utilisateur ? 'selected' : '' }}>
                    {{ $coiffeur->prenom }} {{ $coiffeur->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Date début :</label>
        <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Date fin :</label>
        <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">🔍 Filtrer</button>
    </div>
</form>

    <h2 class="mb-4 text-center"> Services Terminés</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Client</th>
                    <th>Coiffeur</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->date_heure_reservation->format('d/m/Y H:i') }}</td>
                        <td>{{ $reservation->service->nom_service }}</td>
                        <td>{{ $reservation->client->getNomCompletAttribute() }}</td>
                        <td>{{ $reservation->coiffeur->getNomCompletAttribute() }}</td>
                        <td>{{ $reservation->notes ? e($reservation->notes) : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">Aucun service terminé pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $reservations->links() }}
    </div>
</div>

<footer class="text-center mt-5 pt-4 border-top">
    <p class="text-muted small mb-0">
        &copy; <script>document.write(new Date().getFullYear());</script> <strong>SalOOn</strong> – Tous droits réservés.
    </p>
</footer>
@endsection
