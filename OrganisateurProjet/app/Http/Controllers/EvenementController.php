<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //recupere tous les evenment 
    public function index()
    {
        return Evenement::with(['categorie', 'emplacement'])->get();

    }

    /**
     * Store a newly created resource in storage.
     */
    //creer un nouveau event 
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

        return response()->json($evenement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
               return Evenement::with(['categorie', 'emplacement'])->findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           $evenement = Evenement::findOrFail($id);

        $validated = $request->validate([
            'categorie_id' => 'sometimes|exists:categories,id',
            'emplacement_id' => 'sometimes|exists:emplacements,id',
            'titre' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'date_evenement' => 'sometimes|date',
        ]);

        $evenement->update($validated);

        return response()->json($evenement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        return response()->json(['message' => 'Événement supprimé.']);
    }
    public function clients($id)
{
    $evenement = \App\Models\Evenement::findOrFail($id);

    return $evenement->clients; // Liste des utilisateurs ayant payé
}

}
