<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- En-tête -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    {{ isset($evenement) ? 'Modifier' : 'Créer' }} un Événement
                </h2>
            </div>

            <!-- Formulaire -->
            <div class="p-6 space-y-6">
                <form method="POST" 
                    action="{{ isset($evenement) 
                        ? route('organisateur.evenements.update', $evenement->id) 
                        : route('organisateur.evenements.store') }}">
                    @csrf
                    @if(isset($evenement)) @method('PUT') @endif

                    <!-- Titre -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Titre de l'événement *</label>
                        <input type="text" 
                            name="titre"
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('titre') border-red-500 @enderror"
                            value="{{ old('titre', $evenement->titre ?? '') }}"
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
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('date_evenement') border-red-500 @enderror"
                            value="{{ old('date_evenement', isset($evenement) ? $evenement->date_evenement->format('Y-m-d\TH:i') : '') }}"
                            required>
                        @error('date_evenement')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catégorie et Lieu -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Catégorie -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Catégorie *</label>
                            <select name="categorie_id"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('categorie_id') border-red-500 @enderror"
                                required>
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" 
                                    {{ old('categorie_id', $evenement->categorie_id ?? '') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lieu -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Lieu *</label>
                            <select name="emplacement_id"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('emplacement_id') border-red-500 @enderror"
                                required>
                                <option value="">Sélectionnez un lieu</option>
                                @foreach($emplacements as $emplacement)
                                <option value="{{ $emplacement->id }}" 
                                    {{ old('emplacement_id', $evenement->emplacement_id ?? '') == $emplacement->id ? 'selected' : '' }}>
                                    {{ $emplacement->nom }} - {{ $emplacement->adresse }}
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
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('description') border-red-500 @enderror"
                            rows="4"
                            placeholder="Décrivez votre événement...">{{ old('description', $evenement->description ?? '') }}</textarea>
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
                                class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all">
                            <i class="fas fa-save"></i>
                            {{ isset($evenement) ? 'Mettre à jour' : 'Créer l\'événement' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236b7280'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.5em;
        }

        input:focus, select:focus, textarea:focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        button:hover {
            transform: translateY(-1px);
        }
    </style>
</x-app-layout>