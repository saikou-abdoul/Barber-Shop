<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
          
        $user = Auth::user();
        
        if ($user->isClient()) {
            return $this->clientDashboard();
        } elseif ($user->isCoiffeur()) {
            return $this->coiffeurDashboard();
        } else {
            return $this->adminDashboard();
        }
    }

    public function clientDashboard()
    {   
        
        $user = Auth::user();
        
        $stats = [
            'total_reservations' => $user->reservationsClient()->count(),
            'reservations_confirmees' => $user->reservationsClient()->confirme()->count(),
            'reservations_en_attente' => $user->reservationsClient()->enAttente()->count(),
        ];

        $prochaines_reservations = $user->reservationsClient()
            ->with(['service', 'coiffeur'])
            ->where('date_heure_reservation', '>=', now())
            ->orderBy('date_heure_reservation')
            ->limit(5)
            ->get();

        return view('dashboards.client', compact('stats', 'prochaines_reservations',));
    }

    public function coiffeurDashboard()
    {   
          
        $user = Auth::user();
        
        $stats = [
            'total_reservations' => $user->reservationsCoiffeur()->count(),
            'reservations_aujourd_hui' => $user->reservationsCoiffeur()
                ->whereDate('date_heure_reservation', today())
                ->count(),
            'reservations_en_attente' => $user->reservationsCoiffeur()->enAttente()->count(),
        ];

        $planning_jour = $user->reservationsCoiffeur()
            ->with(['client', 'service'])
            ->whereDate('date_heure_reservation', today())
            ->orderBy('date_heure_reservation')
            ->get();

        return view('dashboards.coiffeur', compact('stats', 'planning_jour'));
    }

    public function adminDashboard()
    {
        $stats = [
            'total_utilisateurs' => Utilisateur::count(),
            'total_reservations' => Reservation::count(),
            'reservations_aujourd_hui' => Reservation::whereDate('date_heure_reservation', today())->count(),
            'services_actifs' => Service::actif()->count(),
        ];

        $reservations_recentes = Reservation::with(['client', 'service', 'coiffeur'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

            
    // Statistiques par coiffeur
    $stats_par_coiffeur_par_jour = Reservation::selectRaw('id_utilisateur_coiffeur, DATE(date_heure_reservation) as jour, COUNT(*) as total')
    ->groupBy('id_utilisateur_coiffeur', 'jour')
    ->with('coiffeur')
    ->orderBy('jour')
    ->get();

    $stats_par_coiffeur = Reservation::selectRaw('id_utilisateur_coiffeur, COUNT(*) as total')
     ->groupBy('id_utilisateur_coiffeur')
     ->with('coiffeur') // Nécessite une relation coiffeur dans Reservation
     ->get();

        return view('dashboards.admin', compact('stats', 'reservations_recentes', 'stats_par_coiffeur', 'stats_par_coiffeur_par_jour' ));
    }
}