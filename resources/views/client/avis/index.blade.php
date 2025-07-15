@extends('layouts.app')

@section('title', 'Avis clients')

@section('content')
<div class="container py-5">
    
    <!-- 🔙 Retour et Titre -->
    <div class="position-relative text-center mb-5">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-circle position-absolute start-0 top-0"
           style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="fw-bold text-dark">Avis des clients</h2>
        <p class="text-muted">
            Moyenne générale : 
            <span class="badge bg-warning text-dark fs-6">{{ number_format($moyenne, 1) }}/5</span> ⭐
        </p>
    </div>

    <!-- 🔔 Messages d'alerte -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠ Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>🔸 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- ✍️ Formulaire d'avis -->
    @auth
        <div class="card shadow-sm mb-5">
            <div class="card-header fw-bold text-dark" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                Laissez votre avis
            </div>
            <div class="card-body">
                <form action="{{ route('avis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <select name="note" class="form-select" required>
                            <option value="">Sélectionner une note</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('note') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ str_repeat('★', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Commentaire (facultatif)</label>
                        <textarea name="commentaire" class="form-control" rows="3" placeholder="Décrivez votre expérience...">{{ old('commentaire') }}</textarea>
                    </div>
                    <button type="submit" class="btn w-100 btn-outline-primary">
                        <i class="bi bi-send me-1"></i> Envoyer
                    </button>
                </form>
            </div>
        </div>
    @endauth

    <!-- 💬 Liste des avis -->
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse($avis as $item)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="text-warning mb-0">
                                {{ str_repeat('★', $item->note) }}
                                <small class="text-muted">({{ $item->note }}/5)</small>
                            </h5>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->date)->diffForHumans() }}</small>
                        </div>
                        <p class="mb-2">{{ $item->commentaire ?? '— Aucun commentaire rédigé.' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted"> 
                                  <!-- PHOTO DE PROFIL -->
                              @if(auth()->check())
                              <img src="{{ $item->client->photo 
                              ? asset('images/profils/' . $item->client->photo)
                              : asset('images/i9.png') }}" 
                               alt="Photo de profil"
                               class="rounded-circle shadow mb-3"
                               width="70" height="90" style="object-fit: cover; overflow: hidden;  border-radius: 12px;  object-fit: cover;">
                              @endif
                                {{ $item->client->prenom ?? 'Client anonyme' }}</span>
                            @auth
                            @if ( $item->id_utilisateur_client == Auth::id())
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('avis.edit', $item->id_avis) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                            <i class="bi bi-pencil me-1"></i> Modifier
                                        </a>
                                        <form action="{{ route('avis.destroy', $item->id_avis) }}" method="POST"
                                              onsubmit="return confirm('❌ Supprimer cet avis ?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                                <i class="bi bi-trash me-1"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-info text-center">ℹ Aucun avis pour le moment.</div>
            </div>
        @endforelse
    </div>

    <!-- 📄 Pagination -->
    @if ($avis->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $avis->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>
@endsection


{{--  
@extends('layouts.app')

@section('title', 'Avis clients')

@section('content')
<div class="container py-5">
     <div class="mb-5 position-relative text-center">
     <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0 top-0 rounded-circle" 
         style="width: 40px; height: 40px;">
         <i class="bi bi-arrow-left"></i>
     </a>
    </div>
    <!-- ✅ Alertes -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠ Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>🔸 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 📢 Titre principal -->
    <div class="text-center">
        <h2 class="fw-bold text-dark">Avis des clients</h2>
        <p class="text-muted">
            Moyenne générale : <span class="badge bg-warning text-dark fs-6">{{ number_format($moyenne, 1) }}/5</span> ⭐
        </p>
    </div>

    <!-- 📝 Formulaire pour laisser un avis -->
    @auth
        <div class="card shadow-sm mb-5">
            <div class="card-header text-dark fw-bold" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                 Laissez votre avis
            </div>
            <div class="card-body">
                <form action="{{ route('avis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <select name="note" class="form-select" required>
                            <option value="">Sélectionner une note</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('note') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ str_repeat('★', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Commentaire (facultatif)</label>
                        <textarea name="commentaire" class="form-control" rows="3" placeholder="Décrivez votre expérience...">{{ old('commentaire') }}</textarea>
                    </div>
                    <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">Envoyer </button>
                </form>
            </div>
        </div>
    @endauth

    <!-- 💬 Liste des avis -->
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse($avis as $item)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="text-warning mb-0">
                                {{ str_repeat('★', $item->note) }}
                                <small class="text-muted">({{ $item->note }}/5)</small>
                            </h5>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->date)->diffForHumans() }}</small>
                        </div>
                        <p class="mb-2">{{ $item->commentaire ?? '— Aucun commentaire rédigé.' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">👤 {{ $item->client->prenom ?? 'Client anonyme' }}</span>

                            @auth
                                @if ($item->id_Utilisateur_client == Auth::id())
                                    <div>
                                        <a href="{{ route('avis.edit', $item->id_avis) }}" class="btn btn-sm btn-outline-secondary">✏ Modifier</a>
                                        <form action="{{ route('avis.destroy', $item->id_avis) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Supprimer cet avis ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">🗑 Supprimer</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-info text-center">ℹ Aucun avis pour le moment.</div>
            </div>
        @endforelse
    </div>

    <!-- 📄 Pagination -->
    @if ($avis->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $avis->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
--}}





























