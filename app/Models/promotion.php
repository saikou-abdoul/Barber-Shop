<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
     protected $table = 'promotions';
    protected $primaryKey = 'id_promotion';
    public $timestamps = false;

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'id_service',
        'image',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }

     public function estActive()
    {
        return now()->between($this->date_debut, $this->date_fin);
    }
}

