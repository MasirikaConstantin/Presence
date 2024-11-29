<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use Illuminate\Http\Request;

class GestionLieux extends Controller
{
    public function new(){
        return view('lieux.new',['lieux'=>Lieu::all()]);
    }
    

    public function index()
    {
        $lieux = Lieu::orderBy('nom')->get();
        return view('lieux.create', compact('lieux'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'h_debut'=>'required', 'h_fin'=>'required',
        ]);

        Lieu::create($validated);

        return redirect()->route('lieux.create')
            ->with('success', 'Lieu ajouté avec succès.');
    }

    public function update(Request $request, Lieu $lieu)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'h_debut'=>'required', 'h_fin'=>'required',
        ]);

        $lieu->update($validated);

        return redirect()->route('lieux.create')
            ->with('success', 'Lieu modifié avec succès.');
    }

    public function destroy(Lieu $lieu)
    {
        $lieu->delete();

        return redirect()->route('lieux.create')
            ->with('success', 'Lieu supprimé avec succès.');
    }
}
