@csrf
<div class="mb-3">
    <label class="form-label">Nom du service</label>
    <input type="text" name="nom_service" class="form-control" value="{{ old('nom_service', $service->nom_service ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $service->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="image" class="form-label">Image du service</label>
    @if (!empty($service->image))
    <div class="mb-3">
        <img src="{{ asset('images/services/' . $service->image) }}" alt="Image actuelle" class="img-thumbnail" style="max-width: 200px;">
    </div>
@endif
    <input type="file" name="image" class="form-control">
    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Prix (CFA)</label>
    <input type="number" name="prix" class="form-control" step="0.01" value="{{ old('prix', $service->prix ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Durée (minutes)</label>
    <input type="number" name="duree_minutes" class="form-control" value="{{ old('duree_minutes', $service->duree_minutes ?? '') }}" required>
</div>

<div class="form-check mb-3">
    <input type="checkbox" id="actif" name="actif" class="form-check-input" value="1" @checked(old('actif', $service->actif ?? false))>
        <label class="form-check-label" for="actif">Actif</label>
</div>

<button type="submit" class="btn btn-success">Valider</button>
<a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>


<footer class="text-center mt-5 pt-4 border-top">
    <p class="text-muted small mb-0">
        &copy; <script>document.write(new Date().getFullYear());</script> <strong>SalOOn</strong> – Tous droits réservés.
    </p>
</footer>