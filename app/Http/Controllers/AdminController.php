<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function statistiques()
{
    // Statistique par coiffeur (total)
    $stats_par_coiffeur = Reservation::selectRaw('id_utilisateur_coiffeur, COUNT(*) as total')
        ->groupBy('id_utilisateur_coiffeur')
        ->with('coiffeur')
        ->get();

    // Statistique par coiffeur et par jour
    $stats_par_coiffeur_par_jour = Reservation::selectRaw('id_utilisateur_coiffeur, DATE(date_heure_reservation) as jour, COUNT(*) as total')
        ->groupBy('id_utilisateur_coiffeur', 'jour')
        ->with('coiffeur')
        ->orderBy('jour')
        ->get();

    return view('admin.statistiques', compact('stats_par_coiffeur', 'stats_par_coiffeur_par_jour'));
}

}
