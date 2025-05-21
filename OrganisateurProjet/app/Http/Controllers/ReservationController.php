<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    public function create(Evenement $evenement)
    {
        // Vérifier la disponibilité avant d'afficher le formulaire
        if ($evenement->nombre_tickets <= 0) {
            return redirect()->back()
                ->with('error', 'Désolé, il n\'y a plus de tickets disponibles pour cet événement.');
        }

        return view('utilisateur.reservations.create', compact('evenement'));
    }

    public function store(Request $request, Evenement $evenement)
    {
        // 1. Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nombre_tickets' => [
                'required',
                'integer',
                'min:1',
                'max:' . $evenement->nombre_tickets,

            ],
        ]);

        // 2. Calcul du montant
        $montantTotal = $evenement->prix_ticket * $validated['nombre_tickets'];

        // 3. Création de la réservation
        $reservation = Reservation::create([
            'evenement_id' => $evenement->id,
            'user_id' => Auth::id(), // Utilisation de Auth::id() au lieu de auth()->id()
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'nombre_tickets' => $validated['nombre_tickets'],
            'montant_total' => $montantTotal,
            'statut' => 'en_attente',
            'reference' => 'RES-' . Str::upper(Str::random(10)), // Correction de strtoupper(Str::random())
        ]);

        // 4. Redirection vers le paiement
        return redirect()->route('paiement.checkout', $reservation)
            ->with('success', 'Réservation créée. Veuillez procéder au paiement.');
    }

    public function show(Reservation $reservation)
    {
        // Vérification que l'utilisateur peut voir cette réservation
        if (Auth::id() !== $reservation->user_id) {
            abort(403, 'Accès non autorisé à cette réservation');
        }

        return view('utilisateur.reservations.show', compact('reservation'));
    }

    public function processPayment(Request $request, Reservation $reservation)
    {
        // Vérifications avant paiement
        if ($reservation->statut !== 'en_attente') {
            return redirect()->back()
                ->with('error', 'Cette réservation a déjà été traitée.');
        }

        if ($reservation->evenement->nombre_tickets < $reservation->nombre_tickets) {
            return redirect()->back()
                ->with('error', 'Plus assez de tickets disponibles.');
        }

        // Simulation de paiement (à remplacer par votre logique réelle)
        try {
            // Ici vous intégrerez Stripe, PayPal, etc.
            // Exemple simplifié:
            $paymentSuccess = true; // À remplacer par votre logique de paiement

            if ($paymentSuccess) {
                $reservation->update([
                    'statut' => 'payé',
                    'reference_paiement' => 'PAY-' . uniqid(),
                    'date_paiement' => now(),
                ]);

                $reservation->evenement->decrement('nombre_tickets', $reservation->nombre_tickets);

                // Envoyer un email de confirmation (à implémenter)
                // Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));

                return redirect()->route('reservations.show', $reservation)
                    ->with('success', 'Paiement effectué avec succès!');
            } else {
                throw new \Exception('Le paiement a échoué');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors du paiement: ' . $e->getMessage());
        }
    }
}
