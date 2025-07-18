@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
<div class="container py-5">
    <!-- 🔙 Retour et titre -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="mb-0 text-center flex-grow-1 fw-bold">Mes Réservations</h2>
        <div style="width: 40px;"></div>
    </div>

    <!-- ✅ Message de succès -->
    @if (session('success'))
        <div class="alert alert-success text-center">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- 📋 Tableau des réservations -->
    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Date & Heure</th>
                    <th>Service</th>
                    <th>Coiffeur</th>
                    @if(Auth::user()->isCoiffeur() || Auth::user()->isAdmin())
                        <th>Client</th>
                    @endif
                    <th>Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date_heure_reservation->format('d/m/Y H:i') }}</td>
                    <td>{{ $reservation->service->nom_service ?? '—' }}</td>
                    <td>{{ $reservation->coiffeur->nom ?? '—' }}</td>

                    @if(Auth::user()->isCoiffeur() || Auth::user()->isAdmin())
                        <td>{{ $reservation->client->nom ?? '—' }}</td>
                    @endif

                    <td>
                        <span class="badge bg-{{ 
                            $reservation->statut === 'confirmé' ? 'success' :
                            ($reservation->statut === 'annulé' ? 'danger' :
                            ($reservation->statut === 'terminé' ? 'primary' : 'secondary'))
                        }}">
                            {{ ucfirst($reservation->statut) }}
                        </span>
                    </td>

                    <!-- 🎯 Actions -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center flex-wrap gap-1">
                            <!-- Voir -->
                            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-outline-info" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Coiffeur : Marquer comme terminé -->
                            @if(Auth::user()->isCoiffeur() && $reservation->statut === 'confirmé' && $reservation->id_utilisateur_coiffeur === Auth::id())
                                <form action="{{ route('reservations.done', $reservation) }}" method="POST" onsubmit="return confirm('Confirmer que ce service est terminé ?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Terminer">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                </form>
                            @endif

                            <!-- Client : Modifier -->
                            @if(Auth::user()->isClient() && $reservation->id_utilisateur_client === Auth::id())
                                <a href="{{ route('reservations.edit.client', $reservation) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endif

                            <!-- Client : Supprimer -->
                            @if(Auth::user()->isClient() && $reservation->id_utilisateur_client === Auth::id())
                                <form action="{{ route('reservations.destroy.client', $reservation) }}" method="POST" onsubmit="return confirm('Supprimer cette réservation ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                               @php
    $coiffeurPeutSupprimer = Auth::user()->isCoiffeur() 
        && $reservation->id_utilisateur_coiffeur === Auth::id()
        && $reservation->statut !== 'en attente';
@endphp

@if($coiffeurPeutSupprimer)
    <form action="{{ route('reservations.destroy.coiffeur', $reservation) }}" method="POST"
          onsubmit="return confirm('Supprimer cette réservation ?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" title="Supprimer">
            <i class="bi bi-trash"></i>
        </button>
    </form>
@endif

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucune réservation trouvée.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- 📄 Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $reservations->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection


{{--  

@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px;
     height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Mes Réservations</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

    <h2 class="mb-4 fw-bold text-center"></h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Date & Heure</th>
                    <th>Service</th>
                    <th>Coiffeur</th>
                    @if(Auth::user()->isCoiffeur() || Auth::user()->isAdmin())
                        <th>Client</th>
                    @endif
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date_heure_reservation->format('d/m/Y H:i') }}</td>
                    <td>{{ $reservation->service->nom_service ?? '—' }}</td>
                    <td>{{ $reservation->coiffeur->nom ?? '—' }}</td>

                    @if(Auth::user()->isCoiffeur() || Auth::user()->isAdmin())
                        <td>{{ $reservation->client->nom ?? '—' }}</td>
                    @endif

                    <td>
                        <span class="badge bg-{{ 
                            $reservation->statut === 'confirmé' ? 'success' : 
                            ($reservation->statut === 'annulé' ? 'danger' : 
                            ($reservation->statut === 'terminé' ? 'primary' : 'secondary')) 
                        }}">
                            {{ ucfirst($reservation->statut) }}
                        </span>
                    </td>

                    <td class="d-flex gap-1 flex-wrap">
                        {{-- Voir 
                        <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-outline-info" title="Voir">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Coiffeur : Marquer terminé 
                        @if(Auth::user()->isCoiffeur() && $reservation->statut === 'confirmé' && $reservation->id_utilisateur_coiffeur === Auth::id())
                            <form action="{{ route('reservations.done', $reservation) }}" method="POST" onsubmit="return confirm('Confirmer que ce service est terminé ?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Terminer">
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                            </form>
                        @endif

                        {{-- Client : Modifier 
                        @if(Auth::user()->isClient() && $reservation->id_utilisateur_client === Auth::id())
                            <a href="{{ route('reservations.edit.client', $reservation) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        @endif

                        {{-- Client : Supprimer 
                        @if(Auth::user()->isClient() && $reservation->id_utilisateur_client === Auth::id())
                            <form action="{{ route('reservations.destroy.client', $reservation) }}" method="POST" onsubmit="return confirm('Supprimer cette réservation ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune réservation trouvée.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>


<div class="d-flex justify-content-center mt-3">
    {{ $reservations->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>

@endsection



--}}

{{--  
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Mes Réservations</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date & Heure</th>
                <th>Service</th>
                <th>Coiffeur</th>
                @if(Auth::user()->isCoiffeur() || Auth::user()->isAdmin())
                    <th>Client</th>
                @endif
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->date_heure_reservation->format('d/m/Y H:i') }}</td>
                <td>{{ $reservation->service->nom_service ?? '—' }}</td>
                <td>{{ $reservation->coiffeur->nom ?? '—' }}</td>

                @if(Auth::user()->isCoiffeur() || Auth::user()->isAdmin())
                    <td>{{ $reservation->client->nom ?? '—' }}</td>
                @endif

                <td>
                    <span class="badge bg-{{ $reservation->statut === 'confirmé' ? 'success' : ($reservation->statut === 'annulé' ? 'danger' : 'secondary') }}">
                        {{ ucfirst($reservation->statut) }}
                    </span>
                </td>

                <td class="d-flex gap-1">
                    
                    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-info" title="Voir">
                        <i class="bi bi-eye"></i>
                    </a>

                    
                    @if(Auth::user()->isCoiffeur() 
                        && $reservation->statut === 'confirmé' 
                        && $reservation->id_utilisateur_coiffeur === Auth::id())
                        <form action="{{ route('reservations.done', $reservation) }}" method="POST" onsubmit="return confirm('Confirmer que ce service est terminé ?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" title="Terminer">
                                <i class="bi bi-check2-circle"></i>
                            </button>
                        </form>
                    @endif

                @php
    $user = Auth::user();
@endphp


@if($user->isClient() && $reservation->id_utilisateur_client === $user->id_utilisateur)
    <a href="{{ route('reservations.edit.client', $reservation) }}" class="btn btn-sm btn-warning" title="Modifier">
        <i class="bi bi-pencil-square"></i>
    </a>
@endif

@if(Auth::user()->isClient() && Auth::id() === $reservation->id_utilisateur_client)
    <form action="{{ route('reservations.destroy.client', $reservation) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette réservation ?')">
            <i class="bi bi-trash"></i>
        </button>
    </form>
@endif

                
                    
                    

                    
                     <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Supprimer cette réservation ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" title="Supprimer">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form> 
                     
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Aucune réservation trouvée.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    
    <div class="d-flex justify-content-end">
        {{ $reservations->links() }}
    </div>
    <style>
  
  <style>
.pagination {
    font-size: 0.8rem;
}

.pagination .page-link {
    padding: 0.25rem 0.5rem;
    min-width: 30px;
}
</style>
    
</style>
</div>
@endsection

--}}