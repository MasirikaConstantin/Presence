<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    protected $fillable = ['nom', 'latitude', 'longitude'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'lieu_user')
                    ->withTimestamps();
    }
}
