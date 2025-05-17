<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Categorie;
use App\Models\Emplacement;

class OrganisateurController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:organisateur']);
    }

    public function dashboard()
{
    return view('organisateur.dashboard');
}

    public function createEvent()
    {
        $categories = Categorie::all();
        $emplacements = Emplacement::all();
        return view('organisateur.events.create', compact('categories', 'emplacements'));
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_evenement' => 'required|date',
            'categorie_id' => 'required|exists:categories,id',
            'emplacement_id' => 'required|exists:emplacements,id',
        ]);

        // Ajout automatique de l'ID de l'organisateur connecté
        $validated['user_id'] = auth()->id();

        Evenement::create($validated);

        return redirect()->route('organisateur.dashboard')->with('success', 'Événement créé avec succès');
    }
}
