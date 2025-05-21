<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- En-tête -->
        <div class="bg-gray-800 rounded-t-xl px-6 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Gestion des Événements</h2>
                <p class="mt-1 text-sm text-gray-300">Organisation des événements, catégories et lieux</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('organisateur.categories.index') }}" class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-tags w-4 h-4"></i> Catégories
                </a>
                <a href="{{ route('organisateur.emplacements.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-map-marker-alt w-4 h-4"></i> Lieux
                </a>
                <a href="{{ route('organisateur.evenements.create') }}" class="flex items-center gap-2 px-4 py-2 bg-white hover:bg-gray-50 text-gray-800 rounded-lg transition-colors">
                    <i class="fas fa-plus-circle w-4 h-4"></i> Nouvel Événement
                </a>
            </div>
        </div>

        <!-- Tableau -->
        <div class="bg-white rounded-b-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Prix ticket</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Qantite</th>

                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($evenements as $evenement)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $evenement->titre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                {{ $evenement->date_evenement->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $evenement->categorie->nom ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $evenement->emplacement->nom ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-700">
    {{ number_format($evenement->prix_ticket, 2, ',', ' ') }} TND
</td>
<td class="px-6 py-4 whitespace-nowrap text-right text-gray-700">
    {{ $evenement->nombre_tickets }}
</td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">

                                    <!-- Édition -->
                                    <a href="{{ route('organisateur.evenements.edit', $evenement->id) }}" class="p-2 text-blue-600 hover:text-blue-900 transition-colors">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                    </a>

                                    <!-- Suppression -->
                                    <form action="{{ route('organisateur.evenements.destroy', $evenement->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de cet événement ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:text-red-900 transition-colors">
                                            <i class="fas fa-trash w-5 h-5"></i>
                                        </button>
                                    </form>

                                    <!-- Participants -->
                                    <a href="{{ route('organisateur.evenements.clients', ['evenement' => $evenement->id]) }}" class="p-2 text-teal-600 hover:text-teal-900 transition-colors">
                                        <i class="fas fa-users w-5 h-5"></i>
                                    </a>

                                    <!-- Paiements -->
                                    <a href="{{ route('organisateur.evenements.paiements', ['evenement' => $evenement->id]) }}" class="p-2 text-green-600 hover:text-green-900 transition-colors">
                                        <i class="fas fa-euro-sign w-5 h-5"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
