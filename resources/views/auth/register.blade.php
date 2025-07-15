
@extends('layouts.register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white text-center border-bottom-0">
                    <h4 class="fw-bold mb-0">Inscription</h4>
                    <small class="text-muted">Créez votre compte pour continuer</small>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nom --}}
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input id="nom" type="text" name="nom"
                                   class="form-control @error('nom') is-invalid @enderror"
                                   value="{{ old('nom') }}" required autofocus>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Prénom --}}
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input id="prenom" type="text" name="prenom"
                                   class="form-control @error('prenom') is-invalid @enderror"
                                   value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input id="email" type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mot de passe --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input id="password" type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirmation --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="form-control" required>
                        </div>
                        
                        <input type="hidden" name="id_role" value="3">

                        {{-- Rôle 
                        <div class="mb-3">
                            <label for="id_role" class="form-label">Vous êtes :</label>
                            <select id="id_role" name="id_role"
                                    class="form-select @error('id_role') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un rôle --</option>
                                <option value="2" {{ old('id_role') == 2 ? 'selected' : '' }}>Coiffeur</option>
                                <option value="3" {{ old('id_role') == 3 ? 'selected' : '' }}>Client</option>
                            </select>
                            @error('id_role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    --}}
                        {{-- Bouton --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-person-plus me-1"></i> S'inscrire
                            </button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="bi bi-box-arrow-in-right"></i> Déjà un compte ? Connexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{--  

@extends('layouts.register')


@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded">
                <div class="card-header text-center">
                    <h4>Inscription</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autofocus>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prénom -->
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <!-- Rôle (Client ou Coiffeur) -->
                        <div class="mb-3">
                            <label for="id_role" class="form-label">Vous êtes :</label>
                            <select id="id_role" name="id_role" class="form-select @error('id_role') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un rôle --</option>
                                <option value="2" {{ old('id_role') == 2 ? 'selected' : '' }}>Coiffeur</option>
                                <option value="3" {{ old('id_role') == 3 ? 'selected' : '' }}>Client</option>
                            </select>
                            @error('id_role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('login') }}">Déjà un compte ? Connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

--}}