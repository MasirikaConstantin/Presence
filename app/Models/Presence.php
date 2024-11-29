<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'longitude',
        'latitude',
        'type',
        'date',
        "utilisateur_id",
    ];
    public function user()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id'); // 'user_id' est la clé étrangère
    }

  

public function lieux()
{
    return $this->hasMany(Lieu::class);
}

public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

   
}
