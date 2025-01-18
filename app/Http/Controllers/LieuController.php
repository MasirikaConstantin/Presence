<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Lieu;

class LieuController extends Controller
{
    public function index()
    {
        $lieus = Lieu::all();
        return response()->json($lieus);
    }

    public function show($id)
    {
        $lieu = Lieu::find($id);

        if (!$lieu) {
            return response()->json(['message' => 'Lieu non trouvé'], 404);
        }

        return response()->json($lieu);
    }
}