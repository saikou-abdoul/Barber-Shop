<!-- Modal Profil Utilisateur -->
<div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <div class="modal-header text-dark rounded-top-4"  style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
        <h5 class="modal-title" id="profilModalLabel"><i class="bi bi-person-circle me-1"></i> Mon Profil</h5>
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      @auth
      <form action="{{ route('client.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(session('success'))
          <div class="alert alert-success mx-3 mt-3">
            {{ session('success') }}
          </div>
        @endif

        <div class="modal-body row g-4">

          <!-- 📷 Photo de profil -->
          <div class="col-md-4 text-center">
            <div class="position-relative">
              <a href="{{ auth()->user()->photo 
                ? asset('images/profils/' . auth()->user()->photo)
                : asset('images/i9.png') }}" 
                data-lightbox="photo-profil" 
                data-title="Photo de {{ auth()->user()->prenom }}">
                <img src="{{ auth()->user()->photo 
                    ? asset('images/profils/' . auth()->user()->photo) 
                    : asset('images/i9.png') }}"
                    alt="Photo"
                    class="rounded-circle shadow mb-3"
                    width="120" height="120"
                    style="object-fit: cover;">
              </a>
            </div>

            <input type="file" name="photo" class="form-control mt-2">
            <small class="text-muted">Changer la photo de profil</small>
          </div>

          <!-- 📝 Infos utilisateur -->
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
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Nouveau mot de passe</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Laisser vide si inchangé">
            </div>
          </div>

        </div>

        <div class="modal-footer"  style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
          <button type="submit" >💾 Mettre à jour</button>
        </div>
      </form>
      @else
        <div class="alert alert-danger m-3">Vous devez être connecté pour modifier votre profil.</div>
      @endauth

    </div>
  </div>
</div>



{{--  
<!-- Modal Profil Utilisateur -->
<div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="profilModalLabel">Mon profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      @auth
      <form action="{{ route('client.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(session('success'))
          <div class="alert alert-success mx-3 mt-3">
              {{ session('success') }}
          </div>
        @endif

        <div class="modal-body row g-4">
          <!-- Photo -->
              @if(auth()->check())
<div class="dropdown">
    <a href="#" class="d-inline-block" role="button" id="photoDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ auth()->user()->photo 
            ? asset('images/profils/' . auth()->user()->photo) 
            : asset('images/i9.png') }}" 
            alt="Photo de profil"
            class="rounded-circle shadow"
            width="80" height="80"
            style="object-fit: cover; border-radius: 12px; cursor: pointer;">
    </a>

    <ul class="dropdown-menu text-center" aria-labelledby="photoDropdown">
        @if(auth()->user()->photo)
        <li>
            <a href="{{ asset('images/profils/' . auth()->user()->photo) }}" 
               data-lightbox="photo-profil" 
               data-title="Photo de {{ auth()->user()->prenom }}" 
               class="dropdown-item">
               📷 Voir la photo
            </a>
        </li>
        @endif
       {{--   <li>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profilModal">
           <a href="{{ route('client.profil.update', auth()->user()->id) }}" class="dropdown-item"> 
                👤 Voir mon profil
            </a>
        </li>
        
    </ul>
</div>
@endif
   {{--  
          <div class="col-md-4 text-center">
              @if(auth()->user()->photo)
                  <img src="{{ asset('images/profils/' . auth()->user()->photo) }}" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
              @else
                  <img src="{{ asset('images/i9.png') }}" class="rounded-circle mb-3" width="120" height="120">
              @endif
              <input type="file" name="photo" class="form-control mt-2">
          </div>

          <!-- Infos -->
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
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Nouveau mot de passe</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Laisser vide si inchangé">
              </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
      </form>
      @else
        <div class="alert alert-danger m-3">Vous devez être connecté pour modifier votre profil.</div>
      @endauth

    </div>
  </div>
</div>
--}}