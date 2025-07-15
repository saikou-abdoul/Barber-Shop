<?php

namespace App\Observers;

use App\Models\Fideliter;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationObserver 
{
    public function updated(Reservation $reservation)
    {
        \Log::info('Observer déclenché pour réservation terminée : ID ' . $reservation->id_reservation);

        if ($reservation->getOriginal('statut') !== 'termine'
            && $reservation->statut === 'termine'
        ) {
            Fideliter::firstOrCreate([
                'id_utilisateur_client' => $reservation->id_utilisateur_client
            ], [
                'points' => 0
            ])->increment('points', 10); // +10 pts bonus
        }
    }
}
