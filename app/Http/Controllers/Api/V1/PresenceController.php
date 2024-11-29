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
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'type' => 'required|boolean',
            'date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Convertir la date fournie en objet Carbon pour faciliter la comparaison
        $dateToCheck = Carbon::parse($validated['date'])->format('Y-m-d');

        // Vérifier si l'utilisateur a déjà enregistré une présence avec le même type à la même date
        $existingPresence = Presence::where('utilisateur_id', $validated['utilisateur_id'])
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
            'utilisateur_id' => $validated['utilisateur_id'],
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



    public function checkTodayPresence(Request $request)
    {
        $userId = $request->utilisateur_id; // ou auth()->id() si vous utilisez l'authentification
        $today = Carbon::now()->format('Y-m-d');
        
        $presences = Presence::where('utilisateur_id', $userId)
            ->whereDate('date', $today)
            ->get();

        $status = [
            'debut_a' => false,
            'fin_a' => false,
            'pas_debut' => true,
            'pas_debut' => false,
        ];

        foreach ($presences as $presence) {
            if ($presence->type === 1) { // Début de travail
                $status['debut_a'] = true;
                $status['pas_debut'] = false;
                $status['pas_debut'] = true;
            }
            if ($presence->type === 0) { // Fin de travail
                $status['fin_a'] = true;
                $status['pas_debut'] = false;
            }
        }

        return response()->json([
            'status' => $status,
            'presence_jour' => $presences
        ]);
    }
}