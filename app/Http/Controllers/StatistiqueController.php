<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use App\Models\Lieu;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class StatistiqueController extends Controller
{
    private const EARTH_RADIUS = 6371000;
    public const DEFAULT_RADIUS = 100;
    public function index(Request $request)
{
    $query = Presence::with(['utilisateur.lieu', 'utilisateur.categorie']);

    // Filtre par plage de dates
    if ($request->filled('date_start') || $request->filled('date_end')) {
        $dateStart = $request->filled('date_start') ? Carbon::parse($request->date_start)->startOfDay() : null;
        $dateEnd = $request->filled('date_end') ? Carbon::parse($request->date_end)->endOfDay() : null;

        if ($dateStart && $dateEnd) {
            $query->whereBetween('date', [$dateStart, $dateEnd]);
        } elseif ($dateStart) {
            $query->where('date', '>=', $dateStart);
        } elseif ($dateEnd) {
            $query->where('date', '<=', $dateEnd);
        }
    }

    // Récupérer tous les résultats pour les filtres et les transformations
    $presences = $query->get()->map(function ($presence) {
        // Conversion des coordonnées
        $presenceLat = (float) str_replace(',', '.', $presence->latitude);
        $presenceLon = (float) str_replace(',', '.', $presence->longitude);
        $lieuLat = (float) str_replace(',', '.', $presence->utilisateur->lieu->latitude);
        $lieuLon = (float) str_replace(',', '.', $presence->utilisateur->lieu->longitude);

        // Calcul de la distance
        $distance = $this->calculateDistance($presenceLat, $presenceLon, $lieuLat, $lieuLon);
        $estSurSite = $distance <= self::DEFAULT_RADIUS;

        // Extraction de l'heure
        $heurePresence = Carbon::parse($presence->date)->format('H:i:s');
        
        // Vérification du retard
        if ($presence->type == 1) {
            $heureReference = $presence->utilisateur->lieu->h_debut;
            $retard = $heurePresence > $heureReference;
        } else {
            $heureReference = $presence->utilisateur->lieu->h_fin;
            $retard = $heurePresence < $heureReference;
        }

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

    // Filtre par statut
    if ($request->filled('status')) {
        $status = $request->status;
        $presences = $presences->filter(function ($presence) use ($status) {
            if ($status === 'Présent') {
                return str_contains($presence->statut, 'Présent');
            } elseif ($status === 'Absent') {
                return $presence->statut === 'Absent';
            }
            return true;
        });
    }

    // Recherche rapide
    if ($request->filled('search')) {
        $search = strtolower($request->search);
        $presences = $presences->filter(function ($presence) use ($search) {
            return str_contains(strtolower($presence->utilisateur->name), $search) ||
                   str_contains(strtolower($presence->utilisateur->matricule), $search);
        });
    }

    // Retourner la vue avec toutes les données
    return view('statistiques.index', ['data' => $presences]);
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
        
  