
@extends('layouts.log')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white text-center border-bottom-0">
                    <h4 class="fw-bold mb-0">Connexion</h4>
                    <small class="text-muted">Connectez-vous à votre compte</small>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                      <div class="alert alert-success">
                      {{ session('success') }}
                     </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mot de passe --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Se souvenir --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>

                        {{-- Bouton --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                            </button>
                        </div>

                        {{-- Lien mot de passe oublié (optionnel) --}}
                        {{-- <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Mot de passe oublié ?</a>
                        </div> --}}
                    </form>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="text-decoration-none">
                            <i class="bi bi-person-plus"></i> Pas encore inscrit ? Créez un compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



{{--  

@extends('layouts.log')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow rounded">
                <div class="card-header text-center">
                    <h4>Connexion</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
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

                        <!-- Se souvenir de moi -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>

                        <!-- Bouton -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('register') }}">Pas encore inscrit ? Créez un compte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}