<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id_service';

    protected $fillable = [
        'nom_service',
        'description',
        'prix',
        'duree_minutes',
        'actif',
        'image',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'actif' => 'boolean',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_service', 'id_service');
    }

    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }
}
