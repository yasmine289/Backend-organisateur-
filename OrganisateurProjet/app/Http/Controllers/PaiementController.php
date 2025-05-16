<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($evenement)
{
    $evenement = Evenement::findOrFail($evenement);
    return $evenement->paiements()->with('user')->get();
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'evenement_id' => 'required|exists:evenements,id',
        'montant' => 'required|numeric',
        'statut' => 'required|in:en attente,confirmé,échoué',
        'methode' => 'nullable|string'
    ]);

    $paiement = Paiement::create($validated);

    return response()->json($paiement, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
