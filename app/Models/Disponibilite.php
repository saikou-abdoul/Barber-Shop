<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    protected $primaryKey = 'id_disponibilite';
    protected $fillable = [
        'id_utilisateur_coiffeur',
        'jour',
        'heure_debut',
        'heure_fin',
        'est_disponible',
    ];

    public function coiffeur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur_coiffeur');
    }
}


