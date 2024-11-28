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
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' est la clé étrangère
    }
}
