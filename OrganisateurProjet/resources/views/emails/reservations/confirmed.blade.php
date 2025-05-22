@component('mail::message')
# Confirmation de réservation

Bonjour,

Votre réservation pour **{{ $reservation->evenement->titre }}** a bien été enregistrée.

**Détails de la réservation:**
- Référence: {{ $reservation->reference }}
- Date: {{ $reservation->evenement->date_evenement->format('d/m/Y H:i') }}
- Lieu: {{ $reservation->evenement->emplacement->nom }}
- Nombre de tickets: {{ $reservation->nombre_tickets }}
- Montant total: {{ number_format($reservation->montant_total, 2) }} €

@component('mail::button', ['url' => route('reservations.show', $reservation)])
Voir ma réservation
@endcomponent

Merci pour votre confiance,
L'équipe {{ config('app.name') }}
@endcomponent
