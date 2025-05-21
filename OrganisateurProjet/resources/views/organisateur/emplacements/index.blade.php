<x-app-layout>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- En-tête -->
        <div class="bg-gray-800 px-6 py-4 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-white">Gestion des Lieux</h3>
            <a href="{{ route('organisateur.emplacements.create') }}" 
               class="flex items-center gap-2 px-4 py-2 bg-white text-gray-800 rounded-md hover:bg-gray-50 transition-colors">
                <i class="fas fa-plus-circle"></i>
                <span>Nouveau Lieu</span>
            </a>
        </div>

        <!-- Corps -->
        <div class="p-6">
            <!-- Message de succès -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tableau -->
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Créé le</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($emplacements as $emplacement)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $emplacement->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $emplacement->adresse }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $emplacement->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('organisateur.emplacements.edit', $emplacement->id) }}" 
                                       class="p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-edit w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('organisateur.emplacements.destroy', $emplacement->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
                                                onclick="return confirm('Supprimer ce lieu ?')">
                                            <i class="fas fa-trash w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Aucun lieu enregistré
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>