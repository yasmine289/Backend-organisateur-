<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Interet;
use Illuminate\Http\Request;

class InteretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($evenementId)
    {
        $evenement = Evenement::findOrFail($evenementId);
        return $evenement->interets()->with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'evenement_id' => 'required|exists:evenements,id',
    ]);

    $interet =Interet::firstOrCreate($validated);

    return response()->json($interet, 201);
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
