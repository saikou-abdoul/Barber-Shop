@extends('layouts.app')

@section('content')
<div class="container mt-5">
                  <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-4 text-center">Modifier le coiffeur</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.coiffeurs.update', $coiffeur->id_utilisateur) }}" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $coiffeur->nom) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $coiffeur->prenom) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $coiffeur->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $coiffeur->telephone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Photo</label><br>
            @if($coiffeur->photo)
                <img src="{{ asset('images/profils/' . $coiffeur->photo) }}" width="100" height="100" class="mb-2 rounded-circle" style="object-fit: cover;">
            @endif
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-select">
                <option value="1" {{ $coiffeur->statut ? 'selected' : '' }}>✅ Actif</option>
                <option value="0" {{ !$coiffeur->statut ? 'selected' : '' }}>⛔ Inactif</option>
            </select>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
        </div>
    </form>
</div>

<footer class="text-center mt-5 pt-4 border-top">
    <p class="text-muted small mb-0">
        &copy; <script>document.write(new Date().getFullYear());</script> <strong>SalOOn</strong> – Tous droits réservés.
    </p>
</footer>
@endsection
