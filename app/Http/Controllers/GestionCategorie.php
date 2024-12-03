<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class GestionCategorie extends Controller
{
    public function new(){
        return view('categorie.new',['categories'=>Categorie::orderBy("nom",'asc')->get()]);
    }
    

    public function index()
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('categorie.create', [compact('categories')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|min:3',
            'salaire' => ['required','numeric'],
        ]);

        //dd($validated);
        Categorie::create($validated);

        return redirect()->route('categories.create')
            ->with('success', 'Categorie ajouté avec succès.');
    }

    public function update(Request $request, Categorie $categories)
    {
        $validated = $request->validate([
            'nom' => 'required|min:3',
            'salaire' => ['required','numeric'],
        ]);

        $categories->update($validated);

        return redirect()->route('categories.create')
            ->with('success', 'Categorie modifié avec succès.');
    }

    public function destroy(Categorie $categories)
    {
        $categories->delete();

        return redirect()->route('categories.create')
            ->with('success', 'Categorie supprimé avec succès.');
    }
}
