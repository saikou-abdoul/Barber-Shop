@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="mb-0 text-center flex-grow-1 fw-bold">Promotions en cours</h2>
        <div style="width: 40px;"></div>
    </div>

    @if($promotions->count())
        <div class="row">
            @foreach($promotions as $promo)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if($promo->service && $promo->service->image)
                            <img src="{{ asset('images/services/' . $promo->service->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Image du service">
                        @else
                            <img src="{{ asset('images/default_service.png') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Image par défaut">
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $promo->titre }}</h5>
                            <p class="card-text">{{ $promo->description }}</p>
                            <p class="small text-muted mb-1">
                                <strong>Service :</strong> {{ $promo->service->nom_service ?? 'N/A' }}
                            </p>
                            <p class="small text-muted">
                                <strong>Du</strong> {{ \Carbon\Carbon::parse($promo->date_debut)->format('d/m/Y') }}
                                <strong>au</strong> {{ \Carbon\Carbon::parse($promo->date_fin)->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-muted py-5">
            <p>Aucune promotion active pour le moment.</p>
        </div>
    @endif
</div>
@endsection
