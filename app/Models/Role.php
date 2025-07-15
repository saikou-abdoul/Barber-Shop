<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    
    protected $table = 'roles';
    protected $primaryKey = 'id_role';
    public $incrementing = true;      // <- à ajouter
    protected $keyType = 'int';       // <- à ajouter

    protected $fillable = ['libelle'];

    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'id_role', 'id_role');
    }
}


?>