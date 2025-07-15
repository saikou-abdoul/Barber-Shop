
@extends('layouts.app')

@section('content')
<style>
    .service-card {
        position: relative;
        overflow: hidden;
        height: 300px;
        border-radius: 8px;
    }

    .service-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .service-card:hover img {
        transform: scale(1.05);
    }

    .service-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 15px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .service-card:hover .service-info {
        opacity: 1;
    }

    /* Toujours visible sur mobile */
    @media (max-width: 768px) {
        .service-info {
            opacity: 1 !important;
        }
    }
</style>

<div class="container my-5">
    {{-- fleche de retour 
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4 d-inline-flex align-items-center">
    <i class="bi bi-arrow-left me-2"></i> Retour
</a>--}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Nos Services</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>
    
<!-- Message motivant -->
<div class="alert alert-light border-start border-4 border-primary shadow-sm text-center mb-4" role="alert">
    <h5 class="mb-1"> Prenez soin de vous</h5>
    <p class="mb-0 text-muted fst-italic">"Le bien-être n’est pas un luxe, c’est une priorité."</p>
</div>

    <h2 class="mb-4 text-center fw-bold"></h2>

    <div class="row g-4">
        @foreach($services as $service)
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm border-0 service-card" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <img src="{{ asset('images/services/' . ($service->image ?? 'default.jpg')) }}"
                      class="card-img-top rounded-top img-fluid"
                       alt="{{ $service->nom_service }}"
                        style="height: 200px; object-fit: cover; cursor: zoom-in;"
                         onclick="showImageModal('{{ asset('images/services/' . ($service->image ?? 'default.jpg')) }}')">

                    <div class="service-info">
                        <h5 class="fw-bold">{{ $service->nom_service }}</h5>
                        <p class="mb-1 small">{{ $service->description }}</p>
                        <p class="mb-1"><i class="bi bi-clock me-1"></i> {{ $service->duree_minutes }} min</p>
                        <p class="mb-3"><i class="bi bi-cash-coin me-1"></i> {{ number_format($service->prix, 0, ',', ' ') }} CFA</p>
                       <a href="{{ route('reservations.create', $service->id_service) }}" class="btn btn-outline-primary w-100">
                         Réserver 
                       </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

<!-- Modal image viewer -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0">
        <img id="modalImage" src="" alt="Service image" class="img-fluid w-100">
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
    function showImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
        myModal.show();
    }
</script>

{{--  
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">Nos Services</h2>
    <div class="row g-4">
        @foreach($services as $service)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/services/' . ($service->image ?? 'default.jpg')) }}" 
                         class="card-img-top rounded-top img-fluid" 
                         alt="{{ $service->nom_service }}" 
                         style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">{{ $service->nom_service }}</h5>
                        <p class="card-text text-muted small mb-2">{{ $service->description }}</p>
                        
                        <ul class="list-unstyled mb-3">
                            <li><i class="bi bi-clock me-2 text-primary"></i>Durée : {{ $service->duree_minutes }} minutes</li>
                            <li><i class="bi bi-cash-coin me-2 text-success"></i>Prix : <strong>{{ number_format($service->prix, 0, ',', ' ') }} CFA</strong></li>
                        </ul>
                        
                        <a href="{{ route('reservations.create', ['service_id' => $service->id]) }}" 
                           class="btn btn-outline-primary w-100">
                            Réserver ce service
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
--}}