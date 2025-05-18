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
    $categories = Categorie::withCount('evenements')->paginate(10);
    return view('categories.index', ['categories' => $categories]);
}
public function create()
{
    return view('categories.create');
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255|unique:categories'
    ]);

    Categorie::create($validated);

    return redirect()->route('categories.index')
                    ->with('success', 'Catégorie créée avec succès');
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
    public function update(Request $request, $id)
{
    $categorie = Categorie::findOrFail($id);

    $validated = $request->validate([
        'nom' => 'required|string|max:255|unique:categories,nom,'.$categorie->id
    ]);

    $categorie->update($validated);

    return redirect()->route('categories.index')
                    ->with('success', 'Catégorie mise à jour');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $categorie = Categorie::findOrFail($id);
    $categorie->delete();

    // Redirection avec message flash (pas de réponse JSON)
    return redirect()->route('categories.index')
                    ->with('success', 'Catégorie supprimée avec succès');
}


public function edit($id)
{
    $categorie = Categorie::findOrFail($id);
    return view('categories.edit', compact('categorie'));
}
}
