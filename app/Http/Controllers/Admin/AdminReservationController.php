<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminReservationController extends Controller
{




    public function servicesTermines(Request $request)
{
    $user = Auth::user();

    if (!$user->isAdmin()) {
        abort(403, 'Accès réservé à l\'administration.');
    }

    $query = Reservation::with(['client', 'coiffeur', 'service'])
        ->where('statut', 'terminé');

    // 🔍 Filtres
    if ($request->filled('coiffeur_id')) {
        $query->where('id_utilisateur_coiffeur', $request->coiffeur_id);
    }

    if ($request->filled('date_debut')) {
        $query->whereDate('date_heure_reservation', '>=', $request->date_debut);
    }

    if ($request->filled('date_fin')) {
        $query->whereDate('date_heure_reservation', '<=', $request->date_fin);
    }

    $reservations = $query->orderByDesc('date_heure_reservation')->paginate(10);

    // 📋 Liste des coiffeurs pour le filtre
    $coiffeurs = Utilisateur::where('id_role', 2)->orderBy('nom')->get();

    return view('admin.services-termines', compact('reservations', 'coiffeurs'));
}
 /*
    public function servicesTermines()
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Accès réservé à l\'administration.');
        }

        $reservations = Reservation::with(['client', 'coiffeur', 'service'])
            ->where('statut', 'terminé')
            ->orderByDesc('date_heure_reservation')
            ->paginate(10);

        return view('admin.services-termines', compact('reservations'));
    }
*/
    public function index()
    {
        // Récupérer toutes les réservations pour l'admin
        $reservations = Reservation::with(['utilisateur', 'service'])->latest()->get();

        return view('admin.reservations.index', compact('reservations'));
    }



}

?>