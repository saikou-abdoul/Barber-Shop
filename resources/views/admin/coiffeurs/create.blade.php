@extends('layouts.app')

@section('content')
<div class="container mt-5">
          <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-4 text-center">Ajouter un coiffeur</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.coiffeurs.store') }}" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="mot_de_passe" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmation du mot de passe</label>
            <input type="password" name="mot_de_passe_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-select">
                <option value="1" selected>✅ Actif</option>
                <option value="0">⛔ Inactif</option>
            </select>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">💾 Enregistrer</button>
        </div>
    </form>
</div>

<footer class="text-center mt-5 pt-4 border-top">
    <p class="text-muted small mb-0">
        &copy; <script>document.write(new Date().getFullYear());</script> <strong>SalOOn</strong> – Tous droits réservés.
    </p>
</footer>
@endsection
