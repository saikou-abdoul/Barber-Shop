@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une promotion</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('promotions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date_debut" class="form-label">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
        </div>

        <div class="mb-3">
            <label for="id_service" class="form-label">Service concerné</label>
            <select name="id_service" id="id_service" class="form-control" required>
                <option value="">-- Choisir un service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id_service }}" {{ old('id_service') == $service->id_service ? 'selected' : '' }}>
                        {{ $service->nom_service }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
