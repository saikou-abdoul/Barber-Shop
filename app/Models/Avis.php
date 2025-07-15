<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
     protected $table = 'avis';
    protected $primaryKey = 'id_avis';
    public $timestamps = false;

    protected $fillable = [
        'id_utilisateur_client',
        'note',
        'commentaire',
        'date'
    ];

    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur_client');
    }
}