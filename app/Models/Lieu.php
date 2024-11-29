<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    protected $fillable = ['nom', 'latitude', 'longitude','h_debut', 'h_fin'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'lieu_user')
                    ->withTimestamps();
    }

    
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class); // Lien vers les utilisateurs
    }
}
