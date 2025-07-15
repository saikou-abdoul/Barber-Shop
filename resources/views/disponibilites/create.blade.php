@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0 text-center flex-grow-1 fw-bold">Ajouter une disponibilité</h2>
    <div style="width: 40px;"></div> <!-- Pour équilibrer visuellement avec le bouton -->
</div>

    <h2></h2>

    <form method="POST" action="{{ route('disponibilites.store') }}">
        @csrf

        <div class="mb-3">
            <label for="jour" class="form-label">Jour</label>
            <input type="date" name="jour" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="heure_debut" class="form-label">Heure de début</label>
            <input type="time" name="heure_debut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="heure_fin" class="form-label">Heure de fin</label>
            <input type="time" name="heure_fin" class="form-control" required>
        </div>
        <div class="form-check mb-3">
       <input class="form-check-input" type="checkbox" name="est_disponible" id="est_disponible" value="1" checked>
       <label class="form-check-label" for="est_disponible">
        Disponible
    </label>
</div>


        <button type="submit" class="btn btn-success">Enregistrer</button>
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
