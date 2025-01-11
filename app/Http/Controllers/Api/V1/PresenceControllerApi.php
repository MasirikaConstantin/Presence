<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PresenceResource;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class PresenceControllerApi extends Controller
{
    public function mespresence(Utilisateur $user){
        $presence = $user->presences;

        return response()->json($presence, 201);
        return PresenceResource::collection($presence);
        
    }
}
