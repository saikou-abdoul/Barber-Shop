@extends('layouts.app')

@section('title', 'Modifier votre avis')

@section('content')
<div class="container py-5">
    <div class="position-relative text-center mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0 top-0 rounded-circle" style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="fw-bold">Modifier mon avis</h2>
        <p class="text-muted">Vous pouvez ajuster votre note ou commentaire à tout moment.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light fw-semibold"  style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
            Formulaire de modification
        </div>
        <div class="card-body">
            <form action="{{ route('avis.update', $avis->id_avis) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <select name="note" class="form-select" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $avis->note == $i ? 'selected' : '' }}>
                                {{ $i }} {{ str_repeat('★', $i) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Commentaire</label>
                    <textarea name="commentaire" class="form-control" rows="4" placeholder="Modifiez votre expérience...">{{ old('commentaire', $avis->commentaire) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Mettre à jour
                    </button>
                    <a href="{{ route('avis.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


{{-- 

@extends('layouts.app')

@section('title', 'Modifier votre avis')

@section('content')
<div class="container my-4">
      <div class="mb-5 position-relative text-center">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute 
          start-0 top-0 rounded-circle" 
          style="width: 40px; height: 40px;">
          <i class="bi bi-arrow-left"></i>
      </a>
      <div>
    <h2 class="mb-4 fw-bold">Modifier mon avis</h2>

    <form action="{{ route('avis.update', $avis->id_avis) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Note</label>
            <select name="note" class="form-select" required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $avis->note == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Commentaire</label>
            <textarea name="commentaire" class="form-control" rows="3">{{ $avis->commentaire }}</textarea>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('avis.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

 --}}