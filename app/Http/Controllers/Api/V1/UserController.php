<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidator;
use App\Http\Resources\UserRessource;
use App\Models\Categorie;
use App\Models\Lieu;
use App\Models\Presence;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use \Carbon\Carbon;

class UserController extends Controller
{
    private const EARTH_RADIUS = 6371000;
    public const DEFAULT_RADIUS = 100;
    public function voir($id) {
        $utilisateur = Utilisateur::with(['lieu', 'categorie'])->findOrFail($id);
    
        // Récupérer la date actuelle et celle d'il y a une semaine
        $dateActuelle = Carbon::now();
        $dateSemainePassee = Carbon::now()->subWeek();
    
        // Récupérer les présences séparément
        $presences = Presence::where('utilisateur_id', $id)
            ->whereBetween('date', [$dateSemainePassee, $dateActuelle])
            ->get()
            ->map(function ($presence) use ($utilisateur) {
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
    
        // Calcul des jours travaillés et total à payer
        $joursTravailles = $presences->filter(fn($p) => str_contains($p->statut, 'Présent'))->count();
        $totalPayer = $joursTravailles * $utilisateur->categorie->salaire;
    
        return response()->json([
            'message' => 'Données récupérées avec succès',
            'data' => [
                'utilisateur' => $utilisateur,
                'presences' => $presences,
                'jours_travailles' => $joursTravailles,
                'total_a_payer' => $totalPayer
            ]
        ], 200);
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
public  function mes(){
    $user = User::all();
    return UserRessource::collection($user);
}
}
