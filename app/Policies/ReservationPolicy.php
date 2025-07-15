<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\Utilisateur;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    public function view(Utilisateur $user, Reservation $reservation)
    {
        return $user->isAdmin() || 
               $user->id_utilisateur === $reservation->id_utilisateur_client ||
               $user->id_utilisateur === $reservation->id_utilisateur_coiffeur;
    }

    public function create(Utilisateur $user)
    {
        return $user->isClient();
    }

    public function update(Utilisateur $user, Reservation $reservation)
    {
        return $user->isAdmin() || 
               ($user->isCoiffeur() && $user->id_utilisateur === $reservation->id_utilisateur_coiffeur);
    }

    public function delete(Utilisateur $user, Reservation $reservation)
    {
        return $user->isAdmin() || 
               $user->id_utilisateur === $reservation->id_utilisateur_client;
    }
}