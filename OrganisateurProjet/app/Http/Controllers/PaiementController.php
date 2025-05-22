<?php

namespace App\Http\Controllers;

use App\Mail\ReservationConfirmed;
use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with(['user', 'evenement'])
            ->latest()
            ->paginate(10);

        return view('organisateur.paiements.index', compact('paiements'));
    }


    public function checkout(Reservation $reservation)
    {
        // Vérifier que la réservation est payable
        if ($reservation->statut !== 'en_attente') {
            return redirect()->route('reservations.show', $reservation)
                ->with('error', 'Cette réservation a déjà été traitée.');
        }

        return view('paiement.checkout', compact('reservation'));
    }


    public function process(Request $request, Reservation $reservation)
{
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    try {
        if ($reservation->statut !== 'en_attente') {
            return response()->json([
                'success' => false,
                'message' => 'Cette réservation a déjà été traitée'
            ], 400);
        }

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $reservation->evenement->titre,
                    ],
                    'unit_amount' => $reservation->montant_total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('paiements.success', $reservation) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('paiements.cancel', $reservation),
            'metadata' => [
                'reservation_id' => $reservation->id,
                'user_id' => $reservation->user_id
            ],
        ]);

        return response()->json([
            'success' => true,
            'sessionId' => $session->id
        ]);

    } catch (\Exception $e) {
        Log::error("Erreur Stripe: " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors du traitement du paiement'
        ], 500);
    }
}

public function success(Request $request, Reservation $reservation)
{
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    try {
        $session = \Stripe\Checkout\Session::retrieve($request->session_id);

        if ($session->payment_status === 'paid') {
            // Mettre à jour la réservation
            $reservation->update([
                'statut' => 'payé',
                'reference_paiement' => $session->payment_intent,
                'date_paiement' => now(),
            ]);

            // Créer un enregistrement de paiement
            Paiement::create([
                'user_id' => $reservation->user_id,
                'evenement_id' => $reservation->evenement_id,
                'montant' => $reservation->montant_total,
                'statut' => 'completé',
                'methode' => 'stripe',
                'reference' => $session->payment_intent
            ]);

            // Envoyer l'email de confirmation
            Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));

            return redirect()->route('reservations.show', $reservation)
                ->with('success', 'Paiement confirmé avec succès!');
        }

        return redirect()->route('paiements.cancel', $reservation)
            ->with('error', 'Le paiement n\'a pas été confirmé');

    } catch (\Exception $e) {
        Log::error("Erreur confirmation paiement: " . $e->getMessage());
        return redirect()->route('paiements.cancel', $reservation)
            ->with('error', 'Erreur lors de la confirmation du paiement');
    }
}

public function cancel(Reservation $reservation)
{
    return view('paiement.cancel', compact('reservation'));
}
}
