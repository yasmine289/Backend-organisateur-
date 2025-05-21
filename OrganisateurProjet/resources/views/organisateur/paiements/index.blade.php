<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md">
            <div class="bg-blue-600 px-6 py-4 rounded-t-lg">
                <h2 class="text-2xl font-bold text-white">Liste des Paiements</h2>
            </div>

            <div class="p-6">
                @if($paiements->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-wallet text-4xl mb-4"></i>
                        <p>Aucun paiement trouvé</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utilisateur</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Événement</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Méthode</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($paiements as $paiement)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" 
                                                     src="{{ $paiement->user->profile_photo_url }}" 
                                                     alt="{{ $paiement->user->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">
                                                    {{ $paiement->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $paiement->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        {{ $paiement->evenement->titre }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-blue-600">
                                        {{ number_format($paiement->montant, 2) }} €
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full 
                                            {{ match($paiement->statut) {
                                                'completé' => 'bg-green-100 text-green-800',
                                                'échoué' => 'bg-red-100 text-red-800',
                                                'remboursé' => 'bg-yellow-100 text-yellow-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            } }}">
                                            {{ $paiement->statut }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ ucfirst($paiement->methode) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $paiement->created_at->isoFormat('DD/MM/Y HH:mm') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $paiements->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>