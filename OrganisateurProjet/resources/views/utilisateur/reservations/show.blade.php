<x-app-layout>
<div class="container py-5">
    <div class="alert alert-success">
        <h2 class="mb-3"><i class="fas fa-check-circle"></i> Réservation confirmée</h2>
        <p>Un email de confirmation a été envoyé à <strong>{{ $reservation->email }}</strong>.</p>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h3 class="card-title">Détails de votre réservation</h3>

            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Événement:</strong> {{ $reservation->evenement->titre }}</p>
                    <p><strong>Date:</strong> {{ $reservation->evenement->date_evenement->format('d/m/Y H:i') }}</p>
                    <p><strong>Lieu:</strong> {{ $reservation->evenement->emplacement->nom }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Référence:</strong> {{ $reservation->reference }}</p>
                    <p><strong>Nombre de tickets:</strong> {{ $reservation->nombre_tickets }}</p>
                    <p><strong>Montant total:</strong> {{ number_format($reservation->montant_total, 2) }} €</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('evenements.show', $reservation->evenement) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Retour à l'événement
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
