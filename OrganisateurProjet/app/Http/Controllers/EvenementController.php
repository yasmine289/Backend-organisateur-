<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Emplacement;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EvenementController extends Controller
{
    // ===== Méthodes pour l'organisateur =====

    /**
     * Affiche la liste des événements de l'organisateur
     */
    public function index()
    {
        $evenements = Evenement::with(['emplacement'])
                ->where('date_evenement', '>', now())
                ->orderBy('date_evenement', 'asc')
                ->get();

        return view('organisateur.evenements.index', compact('evenements'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('organisateur.evenements.create', [
            'categories' => Categorie::all(),
            'emplacements' => Emplacement::all()
        ]);
    }

    /**
     * Enregistre un nouvel événement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'date_evenement' => 'required|date|after:now',
            'categorie_id' => 'required|exists:categories,id',
            'emplacement_id' => 'required|exists:emplacements,id',
            'description' => 'nullable|string',
            'prix_ticket' => 'required|numeric|min:0',
            'nombre_tickets' => 'required|integer|min:1'
        ]);

        Evenement::create([
            'user_id' => auth()->id(),
            'titre' => $validated['titre'],
            'date_evenement' => $validated['date_evenement'],
            'categorie_id' => $validated['categorie_id'],
            'emplacement_id' => $validated['emplacement_id'],
            'description' => $validated['description'],
            'prix_ticket' => $validated['prix_ticket'],         
            
    'nombre_tickets' => $validated['nombre_tickets']
        ]);

        return redirect()->route('organisateur.evenements.index')
                        ->with('success', 'Événement créé avec succès');
    }

    /**
     * Affiche un événement spécifique
     */
    public function show(string $id)
    {
$evenement = Evenement::where('user_id', auth()->id())->findOrFail($id);


        return view('organisateur.evenements.show', compact('evenement'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(string $id)
    {
        $evenement = Evenement::where('user_id', auth()->id())
                     ->findOrFail($id);

        return view('organisateur.evenements.edit', [
            'evenement' => $evenement,
            'categories' => Categorie::all(),
            'emplacements' => Emplacement::all()
        ]);
    }

    /**
     * Met à jour un événement
     */
    public function update(Request $request, string $id)
    {
        $evenement = Evenement::where('user_id', auth()->id())
                     ->findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'date_evenement' => 'required|date|after:now',
            'categorie_id' => 'required|exists:categories,id',
            'emplacement_id' => 'required|exists:emplacements,id',
            'description' => 'nullable|string',
            'prix_ticket' => 'required|numeric|min:0',
            'nombre_tickets' => 'required|integer|min:1'
        ]);

        $evenement->update($validated);

        return redirect()->route('organisateur.evenements.index')
                        ->with('success', 'Événement mis à jour avec succès');
    }

    /**
     * Supprime un événement
     */
    public function destroy(string $id)
    {
        $evenement = Evenement::where('user_id', auth()->id())
                     ->findOrFail($id);
        $evenement->delete();

        return redirect()->route('organisateur.evenements.index')
                        ->with('success', 'Événement supprimé avec succès');
    }

    /**
     * Liste des clients d'un événement
     */
    public function clients(string $id)
    {
        $evenement = Evenement::where('user_id', auth()->id())
                     ->with('clients')
                     ->findOrFail($id);

        return view('organisateur.evenements.clients', compact('evenement'));
    }

    // ===== Méthodes pour l'utilisateur =====

    /**
     * Affiche la liste des événements pour l'utilisateur
     */
    public function userIndex(Request $request)  // Add Request $request parameter here
{
    $query = Evenement::query()
        ->with(['categorie', 'emplacement'])
        ->where('date_evenement', '>', now());

    if ($request->filled('search')) {
        $query->where('titre', 'like', '%'.$request->search.'%');
    }

    if ($request->filled('location')) {
        $query->where('emplacement_id', $request->location);
    }

    if ($request->filled('category')) {
        $query->where('categorie_id', $request->category);
    }

    $evenements = $query->orderBy('date_evenement', 'asc')->paginate(12);
    $categories = Categorie::all();
    $emplacements = Emplacement::all();  // Don't forget to add this for your location filter

    return view('utilisateur.evenement.index', compact('evenements', 'categories', 'emplacements'));
}


    /**
     * Affiche un événement pour l'utilisateur
     */
    public function userShow(string $id)
    {
        $evenement = Evenement::with(['categorie', 'emplacement'])
                     ->findOrFail($id);

        return view('utilisateur.evenement.show', compact('evenement'));
    }
}
