<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidator;
use App\Models\Lieu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('users.index',['users'=>User::where("type", 1)->get()]);
    }
    public function create(){
        $lieux = Lieu::orderBy('nom')->get();
        return view('users.create',['lieux' => $lieux,"user"=>new User()]);
    }
    public function store(UserValidator $request)
    {
        

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Attacher le lieu à l'utilisateur
            $user->lieux()->attach($request->lieu_id);

            return redirect()->route('users.create')
                ->with('success', 'Utilisateur créé avec succès.');
    }

    

    public function show(User $user){
        $lieux = Lieu::orderBy('nom')->get();
        return view('users.create',['user' => $user,'lieux' => $lieux]);
    }

    public function update(User $user , Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lieu_id' => 'required|exists:lieus,id',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);
    
        // Mettre à jour les informations de l'utilisateur
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);
    
        // Synchroniser le lieu
        $user->lieux()->sync([$validated['lieu_id']]);
    
        return redirect()->route('users.index')->with('success', 'Utilisateur  mis à jour avec succès.');
    
    }

    
}
