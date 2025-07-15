@extends('layouts.app')

@section('content')
<div class="container my-5">
<div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
         <i class="bi bi-arrow-left"></i>
 </a>
     <h2 class="mb-0 text-center flex-grow-1 fw-bold">Promotions en cours</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

    @if($promotions->count())
        <div class="row">
            @foreach($promotions as $promo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $promo->titre }}</h5>
                            <p class="card-text">{{ $promo->description }}</p>
                            <p class="text-muted">
                                <strong>Service :</strong> {{ $promo->service->nom_service ?? 'N/A' }}<br>
                                <strong>Du</strong> {{ \Carbon\Carbon::parse($promo->date_debut)->format('d/m/Y') }}
                                <strong>au</strong> {{ \Carbon\Carbon::parse($promo->date_fin)->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">Aucune promotion active pour le moment.</p>
    @endif
</div>
@endsection
