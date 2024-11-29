<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Lieu;
use App\Models\Presence;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        
        $request->session()->regenerate();

        $authUserRole = Auth::user()->etat;

        
        $users = Utilisateur::with('lieu')->get();
    
    $todayPresences = Presence::whereDate('created_at', today())->count();
    $totalAgents = Utilisateur::count();
    $totalLieux = Lieu::count();
    
    // Calculer le taux de présence
    $totalExpected = $totalAgents;
    $presentToday = Presence::whereDate('created_at', today())
        ->where('type', 1)
        ->count();
    $tauxPresence = $totalExpected > 0 ? round(($presentToday / $totalExpected) * 100) : 0;

    // Récupérer les dernières activités 
    
        if ($authUserRole == 0){
            return view('dashboard', compact(
                'users',
                'todayPresences',
                'totalAgents', 
                'totalLieux',
                'tauxPresence',
                //'recentActivities'
            ));
        }else if ($authUserRole == 1){
            return redirect()->intended(route('autres', absolute: false));
        }else {
            return redirect()->intended(route('autres', absolute: false));

        }
        
            
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
