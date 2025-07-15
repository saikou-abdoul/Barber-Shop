<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fideliter extends Model
{
     protected $table = 'fideliter';
    public $timestamps = true;

    protected $fillable = [
        'id_utilisateur_client',
        'points'
    ];

    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur_client');
    }
    
    public function getNiveauAttribute()
{
    if ($this->points >= 250) {
        return 'Or';
    } elseif ($this->points >= 100) {
        return 'Argent';
    }
    return 'Bronze';
}

}
