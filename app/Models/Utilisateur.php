<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;  // Ajoutez cette ligne


class Utilisateur extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */


    protected $guard ="utilisateur";
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        "matricule",
        "type",
        'etat',
        'password',
        'lieu_id',
        'categorie_id',
        "address",
        'image'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->matricule = self::generateMatricule();
        });
    }
    
    private static function generateMatricule()
    {
        $prefix = 'AG';
        $randomNumber = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4)); // 4 caractères aléatoires
        return $prefix . $randomNumber;
    }

    public function lieux()
    {
        return $this->hasMany(Lieu::class);
    }

    public function lieu()
{
    return $this->belongsTo(Lieu::class);  // Un utilisateur appartient à un seul lieu
}

public function imageUrl()
{
    // Vérifie si l'image commence déjà par http ou https
    if (str_starts_with($this->image, 'http')) {
        return $this->image;
    }
    
    // Sinon, retourne l'URL avec Storage
    return Storage::disk('public')->url($this->image);
}


public function getImageAttribute()
{
    if ($this->attributes['image']) {
        return env('APP_URL') . '/storage/' . $this->attributes['image'];
    }
    return null;
}



    // Relation avec Categorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relation avec Presence
    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
    public function profilUrl(){
        //return $this->image ? asset('storage/' . $this->image) : null;
        return Storage::disk('public')->url($this->image); 
    }
}
