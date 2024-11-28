<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Lieu;
use App\Models\Presence;
use App\Models\User;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        
        $todayPresences = Presence::whereDate('created_at', today())->count();
        $totalAgents = User::count();
        $totalLieux = Lieu::count();
        
        // Calculer le taux de présence
        $totalExpected = $totalAgents; // Nombre total d'agents attendus
        $presentToday = Presence::whereDate('created_at', today())
            ->where('type', 1) // Présence de type "entrée"
            ->count();
        $tauxPresence = $totalExpected > 0 ? round(($presentToday / $totalExpected) * 100) : 0;
    
        // Récupérer les dernières activités
        $recentActivities = Presence::with('user')
            ->latest()
            ->take(5)
            ->get();
    
            return redirect()->intended(route('dashboard', absolute: false))->with([
                'todayPresences' => $todayPresences,
                'totalAgents' => $totalAgents,
                'totalLieux' => $totalLieux,
                'tauxPresence' => $tauxPresence,
                'recentActivities' => $recentActivities,
            ]);
            
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
