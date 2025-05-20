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
            'description' => 'nullable|string'
        ]);

        Evenement::create([
            'user_id' => auth()->id(),
            'titre' => $validated['titre'],
            'date_evenement' => $validated['date_evenement'],
            'categorie_id' => $validated['categorie_id'],
            'emplacement_id' => $validated['emplacement_id'],
            'description' => $validated['description']
        ]);

        return redirect()->route('organisateur.evenements.index')
                        ->with('success', 'Événement créé avec succès');
    }

    /**
     * Affiche un événement spécifique
     */
    public function show(string $id)
    {
        $evenement = Evenement::where('user_id', auth()->id())
                     ->with(['categorie', 'emplacement', 'clients'])
                     ->findOrFail($id);

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
            'description' => 'nullable|string'
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
    public function userIndex()
    {
        $evenements = Evenement::where('date_evenement', '>', now())
                     ->with(['categorie', 'emplacement'])
                     ->orderBy('date_evenement', 'asc')
                     ->paginate(12);

        return view('utilisateur.evenement.index', compact('evenements'));
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
