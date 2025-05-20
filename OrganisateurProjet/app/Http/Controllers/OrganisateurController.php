<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Categorie;
use App\Models\Emplacement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class OrganisateurController extends Controller
{
    /**
     * Constructeur avec middleware
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:organisateur']);
    }

    /**
     * Affiche le tableau de bord de l'organisateur
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('organisateur.dashboard');
    }

    /**
     * Affiche le formulaire de création d'événement
     *
     * @return \Illuminate\View\View
     */
    public function createEvent()
    {
        return view('organisateur.evenements.create', [
            'categories' => Categorie::orderBy('nom')->get(),
            'emplacements' => Emplacement::orderBy('nom')->get()
        ]);
    }

    /**
     * Enregistre un nouvel événement
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeEvent(Request $request)
    {
        $validated = $this->validateEventRequest($request);

        $evenement = Evenement::create([
            'user_id' => Auth::id(),
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'date_evenement' => $validated['date_evenement'],
            'categorie_id' => $validated['categorie_id'],
            'emplacement_id' => $validated['emplacement_id']
        ]);

        return redirect()
            ->route('organisateur.evenements.index')
            ->with('success', 'Événement créé avec succès');
    }

    /**
     * Valide les données de la requête pour un événement
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateEventRequest(Request $request)
    {
        return $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_evenement' => [
                'required',
                'date',
                'after:'.now()->addDay()->format('Y-m-d')
            ],
            'categorie_id' => [
                'required',
                'exists:categories,id'
            ],
            'emplacements_id' => [
                'required',
                'exists:emplacements,id'
            ],
        ], [
            'date_evenement.after' => 'La date doit être au moins demain'
        ]);
    }
}
