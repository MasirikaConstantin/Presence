<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use App\Models\Presence;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PresenceController extends Controller
{
    private const EARTH_RADIUS = 6371000;
    public const DEFAULT_RADIUS = 100;
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


    

















    public function verifiePresence(Request $request)
    {
        $utilisateur_id = $request->query('utilisateur_id');
        $utilisateur = Utilisateur::find($utilisateur_id);

        if (!$utilisateur) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        $lieu = Lieu::find($utilisateur->lieu_id);

        if (!$lieu) {
            return response()->json(['message' => 'Lieu de travail non trouvé'], 404);
        }

        $presence =  $request->validate(
            [
                'latitude' => 'required|string',
                'longitude' => 'required|string',
    
        ]);
        
       
        $status = [
            'distance' => $this->calculateDistance($lieu->latitude, $lieu->longitude, $presence['latitude'], $presence['longitude']),
        ];

      
        return response()->json(['status' => $status]);
    }

    
    private function calculateDistances($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Rayon de la Terre en mètres

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    private function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
             sin($dLon / 2) * sin($dLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return self::EARTH_RADIUS * $c;
    }
}