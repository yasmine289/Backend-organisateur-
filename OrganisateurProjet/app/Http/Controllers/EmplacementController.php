<?php

namespace App\Http\Controllers;

use App\Models\Emplacement;
use Illuminate\Http\Request;

class EmplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return Emplacement::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255'
        ]);

        $emplacement = Emplacement::create($validated);

        return response()->json($emplacement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Emplacement::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $emplacement = Emplacement::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255'
        ]);

        $emplacement->update($validated);

        return response()->json($emplacement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emplacement = Emplacement::findOrFail($id);
        $emplacement->delete();

        return response()->json(['message' => 'Emplacement supprimé.']);
    }
}
