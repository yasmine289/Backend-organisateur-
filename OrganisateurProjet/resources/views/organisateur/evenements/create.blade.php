<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- En-tête -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">
                    <i class="fas fa-calendar-plus mr-2"></i>Créer un nouvel événement
                </h2>
            </div>

            <!-- Corps du formulaire -->
            <div class="p-6 space-y-6">
                @if(session('success'))
                    <div class="p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('organisateur.evenements.store') }}" class="space-y-6">
                    @csrf

                    <!-- Titre -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Titre *</label>
                        <input type="text" 
                               name="titre"
                               class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('titre') border-red-500 @enderror"
                               value="{{ old('titre') }}"
                               required
                               autofocus>
                        @error('titre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date et Heure -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Date et Heure *</label>
                        <input type="datetime-local" 
                               name="date_evenement"
                               class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('date_evenement') border-red-500 @enderror"
                               value="{{ old('date_evenement') }}"
                               min="{{ now()->format('Y-m-d\TH:i') }}"
                               required>
                        @error('date_evenement')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catégorie et Lieu -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Catégorie *</label>
                            <select name="categorie_id"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('categorie_id') border-red-500 @enderror"
                                    required>
                                <option value="">Choisir une catégorie...</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" 
                                    {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Lieu *</label>
                            <select name="emplacement_id"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('emplacement_id') border-red-500 @enderror"
                                    required>
                                <option value="">Choisir un lieu...</option>
                                @foreach($emplacements as $emplacement)
                                <option value="{{ $emplacement->id }}" 
                                    {{ old('emplacement_id') == $emplacement->id ? 'selected' : '' }}>
                                    {{ $emplacement->nom }} ({{ $emplacement->adresse }})
                                </option>
                                @endforeach
                            </select>
                            @error('emplacement_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description"
                               class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('description') border-red-500 @enderror"
                               rows="5"
                               placeholder="Décrivez votre événement...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
    <label class="form-label">Prix du Ticket (€)</label>
    <input type="number" 
           name="prix_ticket" 
           class="form-control" 
           value="{{ old('prix_ticket', $evenement->prix_ticket ?? '') }}" 
           step="0.01" min="0" required>
</div>

<div class="mb-3">
    <label class="form-label">Nombre de Tickets Disponibles</label>
    <input type="number" 
           name="nombre_tickets" 
           class="form-control" 
           value="{{ old('nombre_tickets', $evenement->nombre_tickets ?? '') }}" 
           min="1" required>
</div>


                    <!-- Actions -->
                    <div class="flex flex-col-reverse md:flex-row justify-between gap-4 pt-8 border-t border-gray-200">
                        <a href="{{ route('organisateur.evenements.index') }}" 
                           class="flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-times"></i>
                            Annuler
                        </a>
                        <button type="submit" 
                                class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all">
                            <i class="fas fa-save"></i>
                            Créer l'événement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Animation des champs */
        input, select, textarea {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Effet de focus amélioré */
        .focus\:ring-blue-200:focus {
            box-shadow: 0 0 0 3px rgba(191, 219, 254, 0.5);
        }
        
        /* Style des icônes */
        .fas {
            width: 1em;
            height: 1em;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Bouton hover */
        button:hover {
            transform: translateY(-1px);
        }
    </style>
</x-app-layout>