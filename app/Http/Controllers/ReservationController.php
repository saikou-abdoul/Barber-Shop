<?php

namespace App\Http\Controllers;

use App\Models\Fideliter;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Utilisateur;
use App\Notifications\CoiffeurReservationReceived;
use App\Notifications\ReservationCancelled;
use App\Notifications\ReservationCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReservationConfirmed;
use App\Notifications\ReservationMade;
use Carbon\Carbon;


class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
public function index()
{
    $user = Auth::user();

    if ($user->isClient()) {
        // Le client ne voit que ses propres réservations
        $reservations = Reservation::where('id_utilisateur_client', $user->id_utilisateur)
            ->with(['service', 'coiffeur', 'client'])
            ->orderByDesc('date_heure_reservation')
            ->paginate(10);
    } elseif ($user->isCoiffeur()) {
        // Le coiffeur voit les siennes
        $reservations = Reservation::where('id_utilisateur_coiffeur', $user->id_utilisateur)
            ->with(['service', 'coiffeur', 'client'])
            ->orderByDesc('date_heure_reservation')
            ->paginate(10);
    } else {
        // Admin : voir tout
        $reservations = Reservation::with(['service', 'coiffeur', 'client'])
            ->orderByDesc('date_heure_reservation')
            ->paginate(10);
    }

    return view('reservations.index', compact('reservations'));
}
/*
    public function index()
    {
         
        $user = Auth::user();
        
        if ($user->isClient()) {
            $reservations = $user->reservationsClient()
                ->with(['service', 'coiffeur'])
                ->orderBy('date_heure_reservation', 'desc')
                ->paginate(10);
                
        } elseif ($user->isCoiffeur()) {
            $reservations = $user->reservationsCoiffeur()
                ->with(['client', 'service'])
                ->orderBy('date_heure_reservation', 'desc')
                ->paginate(10);
        } else {
            $reservations = Reservation::with(['client', 'service', 'coiffeur'])
                ->orderBy('date_heure_reservation', 'desc')
                ->paginate(10);
        }

        return view('reservations.index', compact('reservations'));
    }
*/
    public function create($id_service)
{    
    if (!Auth::user()->isClient()) {
        abort(403, 'Seuls les clients peuvent créer des réservations.');
    }

    // $services = Service::actif()->get();
     $service = Service::actif()->findOrFail($id_service);// Récupère le service choisi


    $coiffeurs = Utilisateur::whereHas('role', function ($query) {
        $query->where('libelle', 'coiffeur');
    })->get();

    return view('reservations.create', compact('service', 'coiffeurs'));
}


   public function store(Request $request)
 {   
     //dd("Méthode destroyClient appelée");
        if (!Auth::user()->isClient()) {
            abort(403, 'Seuls les clients peuvent créer des réservations.');
        }

        $request->validate([
            'id_service' => 'required|exists:services,id_service',
            'id_utilisateur_coiffeur' => 'required|exists:utilisateurs,id_utilisateur',
            'date_heure_reservation' => 'required|date|after:now',
            'notes' => 'nullable|string|max:1000',
        ]);
    
/*      // Vérifier la disponibilité du coiffeur

$start = Carbon::parse($request->date_heure_reservation);
$service = Service::findOrFail($request->id_service); // On récupère la durée du service ici
$end = $start->copy()->addMinutes($service->duree_minutes);

// On vérifie si une réservation du coiffeur chevauche ce créneau
$hasConflict = Reservation::where('id_utilisateur_coiffeur', $request->id_utilisateur_coiffeur)
    ->where('statut', '!=', 'annulé')
    ->where(function ($query) use ($start, $end) {
        $query->whereBetween('date_heure_reservation', [$start, $end])
              ->orWhereRaw('? BETWEEN date_heure_reservation AND DATE_ADD(date_heure_reservation, INTERVAL ? MINUTE)', [$start, $end->diffInMinutes($start)]);
    })->exists();

if ($hasConflict) {
    return back()->withErrors([
        'date_heure_reservation' => 'Ce coiffeur est déjà occupé à cette heure-là.'
    ])->withInput();
}

// Ajout Disponibilité du coiffeur 

$jour = strtolower(Carbon::parse($request->date_heure_reservation)->locale('fr')->dayName);
$heure = Carbon::parse($request->date_heure_reservation)->format('H:i');

// Vérifier si une disponibilité correspond
$dispo = \App\Models\Disponibilite::where('id_utilisateur_coiffeur', $request->id_utilisateur_coiffeur)
    ->where('jour', $jour)
    ->where('heure_debut', '<=', $heure)
    ->where('heure_fin', '>=', $heure)
    ->where('est_disponible', true)
    ->exists();

if (!$dispo) {
    return back()->withErrors([
        'date_heure_reservation' => 'Le coiffeur n’est pas disponible à cette heure.',
    ]);
}     

   */    

       $reservation = Reservation::create([
            'id_utilisateur_client' => Auth::id(),
            'id_service' => $request->id_service,
            'id_utilisateur_coiffeur' => $request->id_utilisateur_coiffeur,
            'date_heure_reservation' => $request->date_heure_reservation,
            'notes' => $request->notes,
            'statut' => 'en_attente',
        ]);
        
        // Charger les relations pour éviter les erreurs dans la notification
       $reservation->load('client', 'coiffeur', 'service');
         // Notifier le client
        Auth::user()->notify(new ReservationCreated($reservation));

        // Notifier le coiffeur
       $reservation->coiffeur->notify(new CoiffeurReservationReceived($reservation));
        // Notifier le coiffeur
       $reservation->coiffeur->notify(new ReservationMade($reservation));

    /*   
    // Ajout automatique de points au client
    $userId = Auth::id();
    $points = 10; // ou calculés selon le service, le montant, etc.
    
    $fidelite = Fideliter::firstOrCreate(
        ['id_utilisateur_client' => $userId],
        ['points' => 0]
    );

    $fidelite->points += $points;
    $fidelite->save();
*/

        return redirect()->route('reservations.index')
            ->with('success', 'Votre réservation a été créée avec succès ');
    }




 /*
public function store(Request $request)
{   
    if (!Auth::user()->isClient()) {
        abort(403, 'Seuls les clients peuvent créer des réservations.');
    }

    $request->validate([
        'id_service' => 'required|exists:services,id_service',
        'id_utilisateur_coiffeur' => 'required|exists:utilisateurs,id_utilisateur',
        'date_heure_reservation' => 'required|date|after:now',
        'notes' => 'nullable|string|max:1000',
    ]);

    $start = Carbon::parse($request->date_heure_reservation);
    $service = Service::findOrFail($request->id_service);
    $end = $start->copy()->addMinutes($service->duree_minutes);

    // Vérifier conflit réservation
    $hasConflict = Reservation::where('id_utilisateur_coiffeur', $request->id_utilisateur_coiffeur)
        ->where('statut', '!=', 'annulé')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('date_heure_reservation', [$start, $end])
                  ->orWhereRaw(
                      '? BETWEEN date_heure_reservation AND DATE_ADD(date_heure_reservation, INTERVAL ? MINUTE)', 
                      [
                          $start, 
                          $end->diffInMinutes($start)
                      ]
                  );
        })
        ->exists();

    if ($hasConflict) {
        return back()->withErrors([
            'date_heure_reservation' => 'Ce coiffeur est déjà occupé à cette heure-là.'
        ])->withInput();
    }

    // Vérifier disponibilité du coiffeur
    $jour = $start->format('Y-m-d');  // Format date YYYY-MM-DD
    $heure = $start->format('H:i:s'); // Format heure HH:MM:SS

    $dispo = \App\Models\Disponibilite::where('id_utilisateur_coiffeur', $request->id_utilisateur_coiffeur)
        ->where('jour', $jour)
        ->where('heure_debut', '<=', $heure)
        ->where('heure_fin', '>=', $heure)
        ->where('est_disponible', true)
        ->exists();

    if (!$dispo) {
        return back()->withErrors([
            'date_heure_reservation' => 'Le coiffeur n’est pas disponible à cette heure.',
        ])->withInput();
    }

    // Création réservation
    $reservation = Reservation::create([
        'id_utilisateur_client' => Auth::id(),
        'id_service' => $request->id_service,
        'id_utilisateur_coiffeur' => $request->id_utilisateur_coiffeur,
        'date_heure_reservation' => $request->date_heure_reservation,
        'notes' => $request->notes,
        'statut' => 'en_attente',
    ]);

    // Charger relations pour notifications
    $reservation->load('client', 'coiffeur', 'service');

    // Notifications
    Auth::user()->notify(new ReservationCreated($reservation));
    $reservation->coiffeur->notify(new CoiffeurReservationReceived($reservation));
    $reservation->coiffeur->notify(new ReservationMade($reservation));

    return redirect()->route('reservations.index')
        ->with('success', 'Votre réservation a été créée avec succès !');
}

 
*/







//-------------
    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        
        return view('reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        
        $request->validate([
            'statut' => 'required|in:confirmé,annulé,en_attente,terminé',
        ]);
        
              
        $user = Auth::user();
        
        // Seuls les coiffeurs et admins peuvent confirmer
        if ($request->statut === 'confirmé' && !($user->isCoiffeur() || $user->isAdmin())) {
            abort(403, 'Vous n\'avez pas le droit de confirmer cette réservation.');
        }

        // Les clients peuvent seulement annuler leurs propres réservations
        if ($user->isClient() && $reservation->id_utilisateur_client !== $user->id_utilisateur) {
            abort(403, 'Vous ne pouvez annuler que vos propres réservations.');
        }

        $reservation->update(['statut' => $request->statut]);

         // Ici, après la mise à jour du statut, ajoute la notification :
    if ($request->statut === 'confirmé') {
        $reservation->client->notify(new ReservationConfirmed($reservation));
    } 

        return back()->with('success', 'Le statut de la réservation a été mis à jour.');
    }

public function markAsDone(Reservation $reservation)
{
    $user = Auth::user();

    // Vérifier si l'utilisateur est le coiffeur concerné
    if (!$user->isCoiffeur() || $reservation->id_utilisateur_coiffeur !== $user->id_utilisateur) {
        abort(403, "Vous ne pouvez pas valider cette réservation.");
    }

    // On ne peut valider qu'une réservation confirmée
    if ($reservation->statut !== 'confirmé') {
        return back()->withErrors(['statut' => 'Seules les réservations confirmées peuvent être marquées comme terminées.']);
    }

    $reservation->update(['statut' => 'terminé']);

    return back()->with('success', 'Réservation marquée comme terminée.');
}

public function getDisponibilites($coiffeurId, $date)
{
    
    $debut = Carbon::parse($date)->setTime(8, 0); // Début de la journée (08:00)
    $fin = Carbon::parse($date)->setTime(18, 0);  // Fin de la journée (18:00)

    $interval = 30; // minutes
    $slots = [];

    // Générer tous les créneaux horaires
    while ($debut->lt($fin)) {
        $slots[] = $debut->copy(); // Important : copy pour ne pas modifier $debut
        $debut->addMinutes($interval);
    }

    // Récupérer toutes les réservations du coiffeur ce jour-là (hors "annulées")
    $reservations = Reservation::where('id_utilisateur_coiffeur', $coiffeurId)
        ->whereDate('date_heure_reservation', $date)
        ->where('statut', '!=', 'annulé')
        ->pluck('date_heure_reservation');

    // Filtrer les créneaux déjà réservés
    $disponibles = collect($slots)->filter(function ($slot) use ($reservations) {
        return !$reservations->contains(function ($res) use ($slot) {
            return Carbon::parse($res)->format('H:i') === $slot->format('H:i');
        });
    })->map(function ($slot) {
        return $slot->format('H:i'); // Format pour l'affichage dans le select
    });

    return response()->json($disponibles);
}


public function annuler(Reservation $reservation)
{
    $user = Auth::user();

    // Seul le client concerné peut annuler
    if ($user->id_utilisateur !== $reservation->id_utilisateur_client || !$user->isClient()) {
        abort(403, 'Vous ne pouvez annuler que vos propres réservations.');
    }

    // Ne pas annuler une réservation déjà annulée ou terminée
    if (in_array($reservation->statut, ['annulé', 'terminé'])) {
        return back()->withErrors(['La réservation ne peut plus être annulée.']);
    }

    $reservation->update([
        'statut' => 'annulé',
    ]);

     // Notification au coiffeur
    if ($reservation->coiffeur && $reservation->coiffeur->email) {
        $reservation->coiffeur->notify(new ReservationCancelled($reservation));
    }

    return back()->with('success', 'Votre réservation a été annulée.');
}

// Dans ReservationController.php

public function edit(Reservation $reservation)
{
    $this->authorize('update', $reservation); // facultatif, si tu utilises les policies

    $services = \App\Models\Service::actif()->get();
    $coiffeurs = \App\Models\Utilisateur::whereHas('role', function ($q) {
        $q->where('libelle', 'coiffeur');
    })->get();

    return view('reservations.edit', compact('reservation', 'services', 'coiffeurs'));
}

public function update(Request $request, Reservation $reservation)
{
    $request->validate([
        'id_service' => 'required|exists:services,id_service',
        'id_utilisateur_coiffeur' => 'required|exists:utilisateurs,id_utilisateur',
        'date_heure_reservation' => 'required|date|after:now',
        'notes' => 'nullable|string|max:1000',
    ]);

    $reservation->update([
        'id_service' => $request->id_service,
        'id_utilisateur_coiffeur' => $request->id_utilisateur_coiffeur,
        'date_heure_reservation' => $request->date_heure_reservation,
        'notes' => $request->notes,
    ]);

    return redirect()->route('reservations.index')
        ->with('success', 'Réservation mise à jour avec succès.');
}

public function destroy(Reservation $reservation)
{
    $user = Auth::user();

    if (!$user->isClient() || $user->id_utilisateur !== $reservation->id_utilisateur_client) {
        abort(403, 'Non autorisé.');
    }

    $reservation->delete();

    return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
}

public function editParClient(Reservation $reservation)
{
    $user = Auth::user();

    // Seul le client peut modifier sa propre réservation
    if (!$user->isClient() || $user->id_utilisateur !== $reservation->id_utilisateur_client) {
        abort(403, 'Vous ne pouvez modifier que vos propres réservations.');
    }

    $services = Service::actif()->get();

    $coiffeurs = Utilisateur::whereHas('role', function ($q) {
        $q->where('libelle', 'coiffeur');
    })->get();

    return view('reservations.edit', compact('reservation', 'services', 'coiffeurs'));
}

public function updateParClient(Request $request, Reservation $reservation)
{
    $user = Auth::user();

    if (!$user->isClient() || $user->id_utilisateur !== $reservation->id_utilisateur_client) {
        abort(403, 'Non autorisé.');
    }

    $request->validate([
        'id_service' => 'required|exists:services,id_service',
        'id_utilisateur_coiffeur' => 'required|exists:utilisateurs,id_utilisateur',
        'date_heure_reservation' => 'required|date|after:now',
        'notes' => 'nullable|string|max:1000',
    ]);

    $reservation->update([
        'id_service' => $request->id_service,
        'id_utilisateur_coiffeur' => $request->id_utilisateur_coiffeur,
        'date_heure_reservation' => $request->date_heure_reservation,
        'notes' => $request->notes,
    ]);

    return redirect()->route('reservations.index')
        ->with('success', 'Réservation mise à jour avec succès.');
}
 
public function destroyClient(Reservation $reservation)
{
       
    $user = Auth::user();

     if (!$user->isClient() || $reservation->id_utilisateur_client !== $user->id_utilisateur) {
        abort(403, 'Vous ne pouvez supprimer que vos propres réservations.');
    }

    // Optionnel : n'autorise que les réservations "en_attente"
   /* if ($reservation->statut !== 'en_attente') {
        return back()->withErrors(['Seules les réservations en attente peuvent être supprimées.']);
    }*/

    $reservation->delete();

    return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
}

public function marquerCommeTerminee(Reservation $reservation)
{
    // Vérifie que l'utilisateur est bien le coiffeur concerné
    if (Auth::id() !== $reservation->id_utilisateur_coiffeur || !Auth::user()->isCoiffeur()) {
        abort(403, 'Action non autorisée.');
    }

    // Vérifie que le statut est "confirmé" avant de le passer à "terminé"
    if ($reservation->statut === 'confirmé') {
        $reservation->statut = 'termine';
        $reservation->save(); // ⚡ Cela déclenche l’observer
    }

    return back()->with('success', 'Le service est marqué comme terminé. 10 points fidélité ajoutés au client.');
}

public function destroyByCoiffeur(Reservation $reservation)
{
    $user = Auth::user();

    if ($user->isCoiffeur() && $reservation->id_utilisateur_coiffeur === $user->id_utilisateur) {
        
        // ❌ Bloquer la suppression si le statut est "en attente"
        if ($reservation->statut === 'en attente') {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer une réservation en attente.');
        }

        // ✅ Autoriser pour les autres statuts
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    abort(403, 'Action non autorisée.');
}



};

