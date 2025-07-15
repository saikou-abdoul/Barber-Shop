@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- 🔙 Bouton retour -->
    <div class="mb-5 position-relative text-center">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute 
            start-0 top-0 rounded-circle" 
            style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold">Mon programme fidélité</h2>
            <p class="text-muted">Suivez votre progression et débloquez des récompenses exclusives.</p>
        </div>
    </div>

    <!-- 🎯 Points et niveau -->
    @if($fidelite)
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <div class="card-body text-center">
                        <h5 class="text-muted mb-2">🎯 Points fidélité</h5>
                        <h3 class="text-primary fw-bold">{{ $fidelite->points }} pts</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <div class="card-body text-center">
                        <h5 class="text-muted mb-2">⭐ Niveau actuel</h5>
                        <span class="badge bg-success fs-5 px-4 py-2">{{ ucfirst($fidelite->niveau) }}</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            Aucun point fidélité trouvé. Commencez à cumuler des points dès aujourd’hui !
        </div>
    @endif

    <!-- 🎁 Récompenses -->
    @if($fidelite)
    <div class="card border-0 shadow-sm">
        <div class="card-header text-dark fw-semibold" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
            🎁 Récompenses disponibles
        </div>
        <ul class="list-group list-group-flush">
            @php
                $recompenses = [
                    ['points' => 100, 'label' => '🔹 100 pts — 10% sur votre prochaine coupe'],
                    ['points' => 200, 'label' => '🔸 200 pts — Coupe gratuite pour enfant'],
                    ['points' => 300, 'label' => '💎 300 pts — Produit capillaire offert'],
                ];
            @endphp

            @foreach($recompenses as $item)
                @php
                    $unlocked = $fidelite->points >= $item['points'];
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center {{ !$unlocked ? 'text-muted' : '' }}">
                    <span>{!! $item['label'] !!}</span>
                    <span class="badge {{ $unlocked ? 'bg-success' : 'bg-secondary' }}">
                        {{ $unlocked ? 'Déverrouillée' : 'Verrouillée' }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- 🔧 Test (facultatif) -->
    {{-- 
    <form action="{{ route('fidelite.ajouter') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-outline-primary">+10 pts (test)</button>
    </form> 
    --}}
</div>
@endsection


{{--  
@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="text-center mb-5">
           <div class="d-flex align-items-center justify-content-between mb-4">
   <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px;
    height: 40px; display: flex; align-items: center; justify-content: center;">
       <i class="bi bi-arrow-left"></i>
   </a>
        <h2 class="fw-bold mb-1">Mon programme fidélité</h2>
        <p class="text-muted">Suivez votre progression et débloquez des récompenses exclusives !</p>
    </div>

    {{-- ✅ Affichage des points et niveau 
    @if($fidelite)
        <div class="card shadow-sm mb-4 border-0" style="background: linear-gradient(135deg, #e0f7fa, #ffffff);">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h5 class="card-title mb-1">🎯 Points fidélité</h5>
                    <p class="fs-4 fw-semibold text-primary mb-0">{{ $fidelite->points }} pts</p>
                </div>
                <div>
                    <h5 class="card-title mb-1">⭐ Niveau actuel</h5>
                    <span class="badge bg-success fs-6">{{ ucfirst($fidelite->niveau) }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            Aucun point fidélité trouvé. Commencez à cumuler des points dès aujourd’hui !
        </div>
    @endif

    {{-- ✅ Récompenses disponibles 
    @if($fidelite)
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold">
                🎁 Récompenses disponibles
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center 
                    {{ $fidelite->points < 100 ? 'text-muted' : '' }}">
                    <span>🔹 100 pts — 10% sur votre prochaine coupe</span>
                    <span class="badge {{ $fidelite->points >= 100 ? 'bg-success' : 'bg-secondary' }}">
                        {{ $fidelite->points >= 100 ? 'Déverrouillée' : 'Verrouillée' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center 
                    {{ $fidelite->points < 200 ? 'text-muted' : '' }}">
                    <span>🔸 200 pts — Coupe gratuite pour enfant</span>
                    <span class="badge {{ $fidelite->points >= 200 ? 'bg-success' : 'bg-secondary' }}">
                        {{ $fidelite->points >= 200 ? 'Déverrouillée' : 'Verrouillée' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center 
                    {{ $fidelite->points < 300 ? 'text-muted' : '' }}">
                    <span>💎 300 pts — Produit capillaire offert</span>
                    <span class="badge {{ $fidelite->points >= 300 ? 'bg-success' : 'bg-secondary' }}">
                        {{ $fidelite->points >= 300 ? 'Déverrouillée' : 'Verrouillée' }}
                    </span>
                </li>
            </ul>
        </div>
    @endif

    {{-- 🔧 Formulaire de test (optionnel) --}}
    {{--
    <form action="{{ route('fidelite.ajouter') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-outline-primary">+10 pts (test)</button>
    </form>
    

</div>
@endsection
--}}

{{-- 

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Mon programme fidélité</h2>

    {{-- ✅ Affichage des points et niveau 
    @if($fidelite)
        <div  style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
            <p>🎯 Vous avez <strong>{{ $fidelite->points }}</strong> points fidélité.</p>
            <p>⭐ Niveau actuel : <strong>{{ $fidelite->niveau }}</strong></p>
        </div>
    @else
        <div class="alert alert-warning">
            Aucun point fidélité trouvé.
        </div>
    @endif

    {{-- ✅ Formulaire pour tester l'ajout de points 
    <form action="{{ route('fidelite.ajouter') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-4">Ajouter 10 points</button>
    </form>
     --}}
    {{-- ✅ 🔥 Récompenses disponibles 
    @if($fidelite)
    <h4>Récompenses disponibles :</h4>
    <ul class="list-group">
        <li class="list-group-item {{ $fidelite->points < 100 ? 'disabled' : '' }}">
            🎁 100 pts — 10% sur votre prochaine coupe
        </li>
        <li class="list-group-item {{ $fidelite->points < 200 ? 'disabled' : '' }}">
            🎁 200 pts — Coupe gratuite pour enfant
        </li>
        <li class="list-group-item {{ $fidelite->points < 300 ? 'disabled' : '' }}">
            🎁 300 pts — Produit capillaire offert
        </li>
    </ul>
    @endif
</div>
@endsection
 --}}