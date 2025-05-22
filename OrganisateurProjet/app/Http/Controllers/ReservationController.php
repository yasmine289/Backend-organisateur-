<?php

namespace App\Http\Controllers;

use App\Mail\ReservationConfirmed;
use App\Models\Evenement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    $montantTotal = $evenement->prix_ticket * $validated['nombre_tickets'];

    $reservation = Reservation::create([
        'evenement_id' => $evenement->id,
        'user_id' => Auth::id(),
        'nom' => $validated['nom'],
        'email' => $validated['email'],
        'nombre_tickets' => $validated['nombre_tickets'],
        'montant_total' => $montantTotal,
        'statut' => 'en_attente',
        'reference_paiement' => 'RES-' . Str::upper(Str::random(10)),
    ]);

    return redirect()->route('paiements.checkout', $reservation)
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
        // Validation et traitement du paiement...

        $reservation->update([
            'statut' => 'payé',
            'reference_paiement' => 'PAY-' . uniqid(),
            'date_paiement' => now(),
        ]);

        // Envoi de l'email de confirmation
        Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Paiement effectué avec succès! Un email de confirmation vous a été envoyé.');
    }
}
