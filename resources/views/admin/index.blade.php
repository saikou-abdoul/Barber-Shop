@extends('layouts.admin')

@section('content')
<div class="container mt-5">
                  <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1>Toutes les réservations</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Service</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->utilisateur->prenom }} {{ $reservation->utilisateur->nom }}</td>
                    <td>{{ $reservation->service->nom }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->heure }}</td>
                    <td>{{ $reservation->statut }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<footer class="text-center mt-5 pt-4 border-top">
    <p class="text-muted small mb-0">
        &copy; <script>document.write(new Date().getFullYear());</script> <strong>SalOOn</strong> – Tous droits réservés.
    </p>
</footer>
@endsection
