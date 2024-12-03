<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidator;
use App\Models\Categorie;
use App\Models\Lieu;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Carbon\Carbon;

class UserController extends Controller
{
    private const EARTH_RADIUS = 6371000;
    public const DEFAULT_RADIUS = 100;
    public function index(){
        $utilisateurs = Utilisateur::with('lieu')->get();        
        return view('users.index',['users'=>$utilisateurs]);
    }
    public function create(){
        $lieux = Lieu::orderBy('nom')->get();
        $categories = Categorie::orderBy('nom')->get();
        return view('users.create',['lieux' => $lieux,"user"=>new User(),'categories'=>$categories]);
    }
    public function store(UserValidator $request)
    {
        

             Utilisateur::create([
                'name' => $request->name,
                "lieu_id" => $request->lieu_id,
                "categorie_id"=>$request->categorie_id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            return redirect()->route('users.create')
                ->with('success', 'Utilisateur créé avec succès.');
    }

    

    public function show(Utilisateur $user){
       // $utilisateur = Utilisateur::with('lieu')->find($user); // Remplacez $id par l'identifiant de l'utilisateur
        
        $lieux = Lieu::orderBy('nom')->get();
        $categories = Categorie::orderBy('nom')->get();

        return view('users.create',['user' => $user,'lieux' => $lieux,'categories' => $categories]);
    }

    public function update(Utilisateur $user , Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lieu_id' => 'required|exists:lieus,id',
            'email' => 'required|email|unique:utilisateurs,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);
    
        // Mettre à jour les informations de l'utilisateur
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'lieu_id' => $validated['lieu_id'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);
    
    
        return redirect()->route('users.index')->with('success', 'Utilisateur  mis à jour avec succès.');
    
    }

    public function voir( $id){
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

    // Calcul des jours travaillés et total à payer
    $joursTravailles = $presences->filter(fn($p) => str_contains($p->statut, 'Présent'))->count();
    $totalPayer = $joursTravailles * $utilisateur->categorie->salaire;

    return view('user-dashboard', compact('utilisateur', 'presences', 'joursTravailles', 'totalPayer'));

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
