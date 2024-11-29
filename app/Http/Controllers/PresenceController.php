<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use App\Models\Lieu;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
ini_set('memory_limit', '256M');

class PresenceController extends Controller
{
    private const EARTH_RADIUS = 6371000;
    public const DEFAULT_RADIUS = 100;
    public function index(Request $request)
{
    $query = Presence::with(['utilisateur.lieu', 'utilisateur.categorie']);

    // Collection pour stocker les résultats transformés
    $transformedPresences = collect();

    // Filtre par date
    if ($request->filled('date')) {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $query->whereDate('date', $date);
    }

    // Récupérer d'abord tous les résultats pour pouvoir les filtrer par statut
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

    // Paginer la collection finale
    $perPage = 100;
    $currentPage = request()->get('page', 1);
    $pagedData = $presences->forPage($currentPage, $perPage);
    
    $presences = new \Illuminate\Pagination\LengthAwarePaginator(
        $pagedData,
        $presences->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );
    //return $presences;
    session(['presences' => $presences]);

    return view('presences.index', compact('presences'));
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



    public function exportPdf(Request $request)
    {
        // Reprenez les mêmes filtres que dans la méthode index
        $query = Presence::with(['utilisateur.lieu', 'utilisateur.categorie']);
    
        if ($request->filled('date_start') && $request->filled('date_end')) {
            $startDate = Carbon::parse($request->date_start)->startOfDay();
            $endDate = Carbon::parse($request->date_end)->endOfDay();
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($request->filled('date')) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $query->whereDate('date', $date);
        }
    
        $presences = $query->get()->map(function ($presence) {
            $presenceLat = (float) str_replace(',', '.', $presence->latitude);
            $presenceLon = (float) str_replace(',', '.', $presence->longitude);
            $lieuLat = (float) str_replace(',', '.', $presence->utilisateur->lieu->latitude);
            $lieuLon = (float) str_replace(',', '.', $presence->utilisateur->lieu->longitude);
    
            $distance = $this->calculateDistance($presenceLat, $presenceLon, $lieuLat, $lieuLon);
            $estSurSite = $distance <= self::DEFAULT_RADIUS;
    
            $heurePresence = Carbon::parse($presence->date)->format('H:i:s');
            $heureReference = $presence->type == 1 
                ? $presence->utilisateur->lieu->h_debut
                : $presence->utilisateur->lieu->h_fin;
    
            $retard = $presence->type == 1 
                ? $heurePresence > $heureReference
                : $heurePresence < $heureReference;
    
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
        $presences = $presences->take(100); // Exemple pour limiter les données
        // Préparez les données pour la vue PDF
        $data = ['presences' => $presences];
    
        // Générez le PDF
        $pdf = Pdf::loadView('presences.pdf', $data);
        return $pdf->stream('presences.pdf'); // Pour afficher dans le navigateur
        // return $pdf->download('presences.pdf'); // Pour télécharger directement
    }
    
   
   
}
        
    
