<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';

    protected $fillable = [
        'id_utilisateur_client',
        'id_service',
        'id_utilisateur_coiffeur',
        'date_heure_reservation',
        'statut',
        'notes',
    ];

    protected $casts = [
        'date_heure_reservation' => 'datetime',
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur_client', 'id_utilisateur');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public function coiffeur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur_coiffeur', 'id_utilisateur');
    }

    // Scopes
    public function scopeConfirme($query)
    {
        return $query->where('statut', 'confirmé');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeAnnule($query)
    {
        return $query->where('statut', 'annulé');
    }
}
