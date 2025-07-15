@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Titre et bouton retour --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="text-center flex-grow-1 mb-0 fw-bold"> Liste des Services</h2>
        <div style="width: 40px;"></div> <!-- pour équilibrer -->
    </div>

    {{-- Bouton ajouter --}}
    <div class="mb-3 text-end">
        <a href="{{ route('services.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un service
        </a>
    </div>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tableau des services --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix (CFA)</th>
                    <th>Durée (min)</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $service->nom_service }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ number_format($service->prix, 0, ',', ' ') }} CFA</td>
                    <td>{{ $service->duree_minutes }} min</td>
                    <td>
                        <span class="badge {{ $service->actif ? 'bg-success' : 'bg-danger' }}">
                            {{ $service->actif ? 'Oui' : 'Non' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-primary me-1" title="Modifier">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce service ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Supprimer">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted">Aucun service enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($services, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $services->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>






@endsection
