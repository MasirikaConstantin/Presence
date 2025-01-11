<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PresenceResource;
use App\Models\Utilisateur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceControllerApi extends Controller
{
    private const EARTH_RADIUS = 6371000;
    public const DEFAULT_RADIUS = 100;
    
    public function mespresences(Utilisateur $user){
        $presence = $user->presences;

        return response()->json($presence, 201);
        return PresenceResource::collection($presence);
        
    }










    public function mespresence($id)
{
    // Récupérer l'utilisateur avec ses relations
    $utilisateur = Utilisateur::with(['lieu', 'categorie', 'presences'])->findOrFail($id);

    // Traitement des présences
    $presences = $utilisateur->presences->map(function ($presence) use ($utilisateur) {
        $presenceLat = (float) str_replace(',', '.', $presence->latitude);
        $presenceLon = (float) str_replace(',', '.', $presence->longitude);
        $lieuLat = (float) str_replace(',', '.', $utilisateur->lieu->latitude);
        $lieuLon = (float) str_replace(',', '.', $utilisateur->lieu->longitude);

        // Calcul de la distance
        $distance = $this->calculateDistance($presenceLat, $presenceLon, $lieuLat, $lieuLon);
        $estSurSite = $distance <= self::DEFAULT_RADIUS;

        // Vérification du retard ou départ prématuré
        $heurePresence = Carbon::parse($presence->date)->format('H:i:s');
        $heureReference = $presence->type == 1 
            ? $utilisateur->lieu->h_debut 
            : $utilisateur->lieu->h_fin;
        $retard = ($presence->type == 1) ? ($heurePresence > $heureReference) : ($heurePresence < $heureReference);

        // Statut
        $statut = $estSurSite 
            ? ($retard 
                ? ($presence->type == 1 ? 'Présent mais en retard' : 'Parti avant l\'heure')
                : ($presence->type == 1 ? 'Présent et à l\'heure' : 'Parti à l\'heure'))
            : 'Absent';

        $presence->distance = $distance;
        $presence->statut = $statut;

        return $presence;
    });

    // Grouper les présences par date
    $presencesParDate = $presences->groupBy(function ($presence) {
        return Carbon::parse($presence->date)->format('Y-m-d'); // Grouper par date (sans l'heure)
    });

    // Compter les jours travaillés
    $joursTravailles = 0;
    foreach ($presencesParDate as $date => $presencesDuJour) {
        // Vérifier si la date contient à la fois une arrivée (type 1) et un départ (type 0)
        $aArrivee = $presencesDuJour->contains('type', 1);
        $aDepart = $presencesDuJour->contains('type', 0);

        if ($aArrivee && $aDepart) {
            $joursTravailles++;
        }
    }

    // Calculer le total à payer
    $totalPayer = $joursTravailles * $utilisateur->categorie->salaire;

    // Retourner la réponse JSON
    return response()->json([
        'presences' => PresenceResource::collection($presences),
        'jours_travailles' => $joursTravailles,
    ]);
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
