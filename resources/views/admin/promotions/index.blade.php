@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des promotions</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Ajouter une promotion</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                 <th>Image</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Service</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->id_promotion }}</td>
                    <td>{{ $promotion->titre }}</td>
                    <td>{{ $promotion->description }}</td>
                     <td>
                       @if($promotion->service && $promotion->service->image)
    <img src="{{ asset('images/services/' . $promotion->service->image) }}"
         alt="Image du service"
         class="img-fluid rounded"
         style="height: 100px; object-fit: cover;">
@else
    <span class="text-muted">Aucune image</span>
@endif    
                     </td>
                    <td>{{ $promotion->date_debut }}</td>
                    <td>{{ $promotion->date_fin }}</td>
                    <td>{{ $promotion->service->nom_service ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('promotions.edit', $promotion->id_promotion) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('promotions.destroy', $promotion->id_promotion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette promotion ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
