<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisponibiliteController extends Controller
{
     public function index()
    {
        $disponibilites = Disponibilite::where('id_utilisateur_coiffeur', Auth::id())->get();
        return view('disponibilites.index', compact('disponibilites'));
    }
    public function create()
    {
        return view('disponibilites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jour' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
                        'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ]);

        Disponibilite::create([
            'id_utilisateur_coiffeur' => Auth::id(),
            'jour' => $request->jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'est_disponible' => $request->has('est_disponible'),

             ]);

        return redirect()->route('disponibilites.index')->with('success', 'Disponibilité ajoutée.');
    }

    public function destroy($id)
{
    $disponibilite = Disponibilite::findOrFail($id);
    $disponibilite->delete();

    return redirect()->route('disponibilites.index')->with('success', 'Disponibilité supprimée avec succès.');
}
    


public function getDisponibilites($coiffeurId, $date)
{
    $jour = strtolower(\Carbon\Carbon::parse($date)->locale('fr')->dayName);

    // 1. Récupère la ou les disponibilités du jour
    $disponibilites = Disponibilite::where('id_utilisateur_coiffeur', $coiffeurId)
        ->where('jour', $jour)
        ->where('est_disponible', true)
        ->get();

    if ($disponibilites->isEmpty()) {
        return response()->json([]); // Pas de dispo
    }

    // 2. Créneaux de 30 min entre heure_debut et heure_fin
    $allSlots = collect();

    foreach ($disponibilites as $dispo) {
        $start = \Carbon\Carbon::parse("$date {$dispo->heure_debut}");
        $end = \Carbon\Carbon::parse("$date {$dispo->heure_fin}");

        while ($start < $end) {
            $allSlots->push($start->copy());
            $start->addMinutes(30);
        }
    }

    // 3. Récupère les heures déjà réservées
    $reservations = Reservation::where('id_utilisateur_coiffeur', $coiffeurId)
        ->whereDate('date_heure_reservation', $date)
        ->where('statut', '!=', 'annulé')
        ->pluck('date_heure_reservation')
        ->map(function ($dt) {
            return \Carbon\Carbon::parse($dt)->format('H:i');
        });

    // 4. Supprime les créneaux déjà réservés
    $disponibles = $allSlots->filter(function ($slot) use ($reservations) {
        return !$reservations->contains($slot->format('H:i'));
    });

    // 5. Format pour l'affichage frontend
    $formatted = $disponibles->map(function ($slot) {
        return [
            'value' => $slot->format('H:i:s'),     // pour <option value="...">
            'label' => $slot->format('H\h:i'),     // affiché à l'utilisateur
        ];
    });

    return response()->json($formatted->values());
}
  
  
  
  
  

  
}

















 





