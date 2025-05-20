@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h3 class="mb-0">Gestion des Paiements</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Utilisateur</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiements as $paiement)
                    <tr>
                        <td>{{ $paiement->user->name }}</td>
                        <td>{{ number_format($paiement->montant, 2) }} €</td>
                        <td>
                            <span class="badge bg-{{ $paiement->statut === 'completé' ? 'success' : 'warning' }}">
                                {{ $paiement->statut }}
                            </span>
                        </td>
                        <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($paiements->hasPages())
        <div class="mt-4">
            {{ $paiements->links() }}
        </div>
        @endif
    </div>
</div>
@endsection