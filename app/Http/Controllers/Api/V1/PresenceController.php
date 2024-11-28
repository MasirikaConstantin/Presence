<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function store(Request $request)
    {
        // Valider les données de la requête
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'type' => 'required|boolean',
            'date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Convertir la date fournie en objet Carbon pour faciliter la comparaison
        $dateToCheck = Carbon::parse($validated['date'])->format('Y-m-d');

        // Vérifier si l'utilisateur a déjà enregistré une présence avec le même type à la même date
        $existingPresence = Presence::where('user_id', $validated['user_id'])
            ->where('type', $validated['type'])
            ->whereDate('date', $dateToCheck)
            ->first();

        if ($existingPresence) {
            return response()->json([
                'message' => 'Vous avez déjà enregistré votre présence pour cette date avec ce type.',
            ], 400);
        }

        // Créer la nouvelle présence
        $presence = Presence::create([
            'user_id' => $validated['user_id'],
            'longitude' => $validated['longitude'],
            'latitude' => $validated['latitude'],
            'type' => $validated['type'],
            'date' => $validated['date'],
        ]);

        return response()->json([
            'message' => 'Présence enregistrée avec succès',
            'data' => $presence,
        ], 201);
    }
}