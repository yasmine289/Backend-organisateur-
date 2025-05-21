<x-app-layout>
    <div class="custom-card max-w-4xl mx-auto">
        <div class="card-header-warning">
            <h3 class="text-2xl font-bold">Liste des Catégories</h3>
            <a href="{{ route('organisateur.categories.create') }}" 
               class="flex items-center gap-2 px-4 py-2 bg-white text-amber-700 rounded-lg hover:bg-amber-50 transition-colors">
                <i class="fas fa-plus-circle"></i> Nouvelle Catégorie
            </a>
        </div>

        <div class="bg-white p-6">
            @if(session('success'))
                <div class="custom-alert alert-success mb-6">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Événements</th>
                            <th>Création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($categories as $categorie)
                        <tr class="hover:bg-amber-50">
                            <td class="font-medium">{{ $categorie->nom }}</td>
                            <td>
                                <span class="event-badge">
                                    {{ $categorie->evenements_count }}
                                </span>
                            </td>
                            <td>{{ $categorie->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('organisateur.categories.edit', $categorie->id) }}" 
                                       class="action-btn bg-amber-100 text-amber-700 hover:bg-amber-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('organisateur.categories.destroy', $categorie->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-btn bg-red-100 text-red-700 hover:bg-red-200"
                                                onclick="return confirm('Confirmer la suppression ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                <i class="fas fa-inbox mr-2"></i>Aucune catégorie trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>