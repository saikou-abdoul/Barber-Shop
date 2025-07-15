<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Utilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';
    

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'id_role',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accesseur pour le mot de passe
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
     
      public function setPasswordAttribute($value)
  {
      $this->attributes['mot_de_passe'] = bcrypt($value);
  }
    // Relations
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function reservationsClient()
    {
        return $this->hasMany(Reservation::class, 'id_utilisateur_client', 'id_utilisateur');
    }

    public function reservationsCoiffeur()
    {
        return $this->hasMany(Reservation::class, 'id_utilisateur_coiffeur', 'id_utilisateur');
    }


    // Méthodes utilitaires;
public function isClient()
{
  return $this->role && $this->role->libelle === 'client';
}

public function isCoiffeur()
{
    return $this->role->libelle === 'coiffeur';
}

public function isAdmin()
{
    return $this->role->libelle === 'admin';
}



    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function disponibilites()
    {
    return $this->hasMany(Disponibilite::class, 'id_utilisateur_coiffeur');
    }

  
  
  
  



}

