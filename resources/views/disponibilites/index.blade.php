@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Mes disponibilités</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

    <h2></h2>

    <a href="{{ route('disponibilites.create') }}" class="btn btn-primary mb-3">Ajouter une disponibilité</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

      <table class="table table-bordered">
    <thead>
        <tr>
            <th>Jour</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Disponible ?</th> <!-- ✅ Nouvelle colonne -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($disponibilites as $dispo)
            <tr>
                <td>{{ \Carbon\Carbon::parse($dispo->jour)->format('d/m/Y') }}</td>
                <td>{{ $dispo->heure_debut }}</td>
                <td>{{ $dispo->heure_fin }}</td>

                <!-- ✅ Affichage de disponibilité -->
                <td>
                    @if($dispo->est_disponible)
                        <span class="badge bg-success">Oui</span>
                    @else
                        <span class="badge bg-danger">Non</span>
                    @endif
                </td>

                <td>
                <form method="POST" action="{{ route('disponibilites.destroy', $dispo) }}">
                     @csrf
                     @method('DELETE')
                 <button class="btn btn-sm btn-danger" title="Supprimer" onclick="return  confirm('Êtes-vous sûr de vouloir supprimer cette disponibilité ?')"><i class="bi bi-trash"></i></button>
                 </form>
                </td>
    
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $reservations->onEachSide(1)->links('pagination::bootstrap-5') }}
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
