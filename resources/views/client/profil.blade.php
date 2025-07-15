@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Mon Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('client.profil.update') }}" method="POST" enctype="multipart/form-data" class="row g-4">
        @csrf
        <!-- Photo de profil -->
        <div class="col-md-4 text-center">
            @if(auth()->user()->photo)
            
                <img src="{{ asset('images/profils/' . auth()->user()->photo) }}" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
            @else
                <img src="{{ asset('images/default-user.png') }}" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
            @endif
            <input type="file" name="photo" class="form-control mt-2">
        </div>

        <!-- Infos personnelles -->
        <div class="col-md-8">
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', auth()->user()->prenom) }}" required>
            </div>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', auth()->user()->nom) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <!-- Mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe (facultatif)</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Laisser vide si inchangé">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>

    <div class="row pt-5 mt-5 text-center">
    <div class="col-md-12">
    <div class="border-top pt-5">
         <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 Copyright &copy;<script>document.write(new Date().getFullYear());</script> SalOOn - Tous droits réservés
               <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
         </p>
    </div>
  </div>
@endsection
 