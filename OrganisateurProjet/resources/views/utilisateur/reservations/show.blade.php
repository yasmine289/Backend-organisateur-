@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Confirmation de réservation</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Réservation #{{ $reservation->id }}</h5>
            <p class="card-text">
                <strong>Événement:</strong> {{ $reservation->evenement->titre }}<br>
                <strong>Date:</strong> {{ $reservation->evenement->date_evenement->format('d/m/Y H:i') }}<br>
                <strong>Nom:</strong> {{ $reservation->nom }}<br>
                <strong>Email:</strong> {{ $reservation->email }}<br>
                <strong>Nombre de tickets:</strong> {{ $reservation->nombre_tickets }}<br>
                <strong>Montant total:</strong> {{ number_format($reservation->montant_total, 2) }} €<br>
                <strong>Statut:</strong>
                <span class="badge bg-{{ $reservation->statut === 'payé' ? 'success' : 'warning' }}">
                    {{ $reservation->statut }}
                </span>
            </p>

            @if($reservation->statut === 'en_attente')
                <form method="POST" action="{{ route('utilisateur.reservations.payment', $reservation) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Procéder au paiement</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
