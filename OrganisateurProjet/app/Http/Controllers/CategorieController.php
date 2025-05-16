<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categorie::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        $categorie = Categorie::create($validated);

        return response()->json($categorie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return Categorie::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $categorie = Categorie::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        $categorie->update($validated);

        return response()->json($categorie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
     {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée.']);
    }
}
