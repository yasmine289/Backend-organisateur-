<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- En-tête -->
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">
                    <i class="fas fa-edit mr-2"></i>Modifier Catégorie
                </h2>
            </div>

            <!-- Formulaire -->
            <div class="p-6 space-y-6">
                <form method="POST" action="{{ route('organisateur.categories.update', $categorie->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Nom de la catégorie *
                        </label>
                        <input type="text" 
                               name="nom"
                               class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 
                                      focus:border-amber-500 focus:ring-2 focus:ring-amber-200
                                      @error('nom') border-red-500 @enderror"
                               value="{{ old('nom', $categorie->nom) }}"
                               required
                               autofocus>
                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-200">
                        <a href="{{ route('organisateur.categories.index') }}" 
                           class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all">
                            <i class="fas fa-save mr-2"></i>Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        button:hover {
            transform: translateY(-1px);
        }
    </style>
</x-app-layout>