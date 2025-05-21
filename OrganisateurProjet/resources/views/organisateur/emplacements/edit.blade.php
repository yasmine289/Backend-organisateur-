<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- En-tête -->
            <div class="bg-gray-800 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">
                    <i class="fas fa-map-marker-alt mr-2"></i>Modifier le Lieu
                </h2>
            </div>

            <!-- Corps du formulaire -->
            <div class="p-6 space-y-8">
                <form method="POST" action="{{ route('organisateur.emplacements.update', $emplacement->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Champ Nom -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Nom du lieu *
                        </label>
                        <input type="text" 
                               name="nom"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                      focus:border-blue-500 focus:ring-blue-500
                                      @error('nom') border-red-500 @enderror"
                               value="{{ old('nom', $emplacement->nom) }}"
                               required
                               autofocus>
                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Champ Adresse -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Adresse *
                        </label>
                        <input type="text" 
                               name="adresse"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                      focus:border-blue-500 focus:ring-blue-500
                                      @error('adresse') border-red-500 @enderror"
                               value="{{ old('adresse', $emplacement->adresse) }}"
                               required>
                        @error('adresse')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-200 mt-8">
                        <a href="{{ route('organisateur.emplacements.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 
                                  text-white rounded-md transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </a>
                        
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 
                                       text-white rounded-md transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>