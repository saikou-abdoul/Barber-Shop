@extends('layouts.app')

@section('content')
<div class="container mt-5">
                  <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-4 text-center"> Liste des coiffeurs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.coiffeurs.create') }}" class="btn btn-success">
            ➕ Ajouter un coiffeur
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coiffeurs->sortBy('nom')->sortBy('prenom') as $coiffeur)
                    <tr>
                        <td>
                            @if($coiffeur->photo)
                                <img src="{{ asset('images/profils/' . $coiffeur->photo) }}" width="50" height="50" class="rounded-circle object-fit-cover">
                            @else
                                <img src="{{ asset('images/i9.png') }}" width="50" height="50" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $coiffeur->prenom }} {{ $coiffeur->nom }}</td>
                        <td>{{ $coiffeur->email }}</td>
                        <td>{{ $coiffeur->telephone ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.coiffeurs.edit', $coiffeur->id_utilisateur) }}" class="btn btn-sm btn-warning">✏️</a>

                            <form action="{{ route('admin.coiffeurs.destroy', $coiffeur->id_utilisateur) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer class="text-center mt-5 pt-4 border-top">
    <p class="text-muted small mb-0">
        &copy; <script>document.write(new Date().getFullYear());</script> <strong>SalOOn</strong> – Tous droits réservés.
    </p>
</footer>
@endsection
