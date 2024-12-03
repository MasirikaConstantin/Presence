<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PdfService;
use App\Models\Presence;
use Carbon\Carbon;
use FPDF;


class PdfController extends Controller
{
    private const EARTH_RADIUS = 6371000;
    public const DEFAULT_RADIUS = 100;
    public function generatePdfsssss()
    {
        $pdf = new PdfService();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, utf8_decode('Bonjour, voici un PDF généré avec FPDF !'));
        $pdf->Output(); // Téléchargement direct ou affichage dans le navigateur

        // Optionnel : Sauvegarder le PDF dans le serveur
        // $pdf->Output('F', storage_path('app/public/example.pdf'));
    }

    public function generatePdf(Request $request)
{
    // Reprenez les mêmes filtres que dans la méthode index
    $query = Presence::with(['utilisateur.lieu', 'utilisateur.categorie'])->orderBy('id', 'desc');
    
    if ($request->filled('date_start') && $request->filled('date_end')) {
        $startDate = Carbon::parse($request->date_start)->startOfDay();
        $endDate = Carbon::parse($request->date_end)->endOfDay();
        $query->whereBetween('date', [$startDate, $endDate]);
    } elseif ($request->filled('date')) {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $query->whereDate('date', $date);
    }

    $presences = $query->get()->map(function ($presence) {
        // Calcul des distances et du statut
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

    // Limiter les résultats pour éviter un PDF surchargé
    $presences = $presences->take(100);

    // Générez le PDF avec FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

    // En-tête du PDF
    $pdf->Cell(0, 10, utf8_decode('Rapport de Présences'), 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 12);

    // Tableau
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(60, 10, 'Nom', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Date', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Heure', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Statut', 1, 1, 'C', true);

    // Contenu des données
    foreach ($presences as $presence) {
        $pdf->Cell(60, 10, utf8_decode($presence->utilisateur->name) ?? 'N/A', 1);
        $pdf->Cell(40, 10, Carbon::parse($presence->date)->format('d-m-Y'), 1);
        $pdf->Cell(30, 10, Carbon::parse($presence->date)->format('H:i:s'), 1);
        $pdf->Cell(50, 10, utf8_decode($presence->statut), 1, 1);
    }

    // Téléchargement ou affichage
    $pdf->Output('I', 'rapport_presences.pdf'); // 'I' pour afficher dans le navigateur

}

private function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        if (!$this->validateCoordinates($lat1, $lon1) || !$this->validateCoordinates($lat2, $lon2)) {
            throw new \InvalidArgumentException('Coordonnées géographiques invalides');
        }
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
             sin($dLon / 2) * sin($dLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return self::EARTH_RADIUS * $c;
    }
    private function validateCoordinates(float $lat, float $lon): bool 
{
    return $lat >= -90 && $lat <= 90 && $lon >= -180 && $lon <= 180;
}
}