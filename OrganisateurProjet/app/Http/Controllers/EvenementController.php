<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    // Récupère tous les événements avec relations
    public function index()
    {
        return response()->json([
            'evenements' => Evenement::with(['categorie', 'emplacement', 'user'])->get()
        ]);
    }

    // Crée un nouvel événement (API)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'categorie_id' => 'required|exists:categories,id',
            'emplacement_id' => 'required|exists:emplacements,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_evenement' => 'required|date',
        ]);

        $evenement = Evenement::create($validated);
        return response()->json($evenement->load(['categorie', 'emplacement']), 201);
    }

    // Affiche un événement spécifique
    public function show(Evenement $evenement)
    {
        return response()->json($evenement->load(['categorie', 'emplacement', 'user']));
    }

    // Met à jour un événement
    public function update(Request $request, Evenement $evenement)
    {
        $validated = $request->validate([
            'categorie_id' => 'sometimes|exists:categories,id',
            'emplacement_id' => 'sometimes|exists:emplacements,id',
            'titre' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'date_evenement' => 'sometimes|date',
        ]);

        $evenement->update($validated);
        return response()->json($evenement->fresh()->load(['categorie', 'emplacement']));
    }

    // Supprime un événement
    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return response()->json(['message' => 'Événement supprimé.'], 204);
    }

    // Liste des clients (utilisateurs) pour un événement
    public function clients(Evenement $evenement)
    {
        return response()->json([
            'clients' => $evenement->clients()->with('user')->get()
        ]);
    }
}
