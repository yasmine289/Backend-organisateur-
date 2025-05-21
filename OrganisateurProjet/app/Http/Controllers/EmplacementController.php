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
    $emplacements = Emplacement::all();

    
    return view('organisateur.emplacements.index', compact('emplacements'));

}

    /**
     * Store a newly created resource in storage.
     */
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
    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $emplacement = Emplacement::findOrFail($id);
    $emplacement->delete();

    return redirect()->route('organisateur.emplacements.index')
                     ->with('success', 'Emplacement supprimé avec succès');
}
    public function create()
{

    return view('organisateur.emplacements.create');
}

// App\Http\Controllers\EmplacementController.php

public function store(Request $request)
{
    // Validation et logique de création
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'adresse' => 'required|string'
    ]);

    Emplacement::create($validated);

    return redirect()->route('organisateur.emplacements.index')
                     ->with('success', 'Lieu créé avec succès');
}

public function edit($id)
{
    $emplacement = Emplacement::findOrFail($id);

    return view('organisateur.emplacements.edit', compact('emplacement'));
 
}

public function update(Request $request, $id)
{
    $emplacement = Emplacement::findOrFail($id);



    $validated = $request->validate([
        'nom' => 'required|string|max:255|unique:emplacements,nom,'.$emplacement->id,
        'adresse' => 'required|string|max:255'
    ]);

    $emplacement->update($validated);

    return redirect()->route('organisateur.emplacements.index')

                    ->with('success', 'Lieu mis à jour avec succès');
}

}
