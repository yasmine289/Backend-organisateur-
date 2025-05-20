@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">{{ isset($evenement) ? 'Modifier' : 'Crèer' }} un Événement</h3>
    </div>

    <div class="card-body">
        <form method="POST" 
              action="{{ isset($evenement) ? route('evenements.update', $evenement->id) : route('evenements.store') }}">
            @csrf
            @if(isset($evenement)) @method('PUT') @endif

            <!-- Titre -->
            <div class="mb-3">
                <label class="form-label">Titre de l'événement *</label>
                <input type="text" 
                       name="titre" 
                       class="form-control @error('titre') is-invalid @enderror" 
                       value="{{ old('titre', $evenement->titre ?? '') }}"
                       required>
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date et Heure -->
            <div class="mb-3">
                <label class="form-label">Date et Heure *</label>
                <input type="datetime-local" 
                       name="date_evenement" 
                       class="form-control @error('date_evenement') is-invalid @enderror"
                       value="{{ old('date_evenement', isset($evenement) ? $evenement->date_evenement->format('Y-m-d\TH:i') : '') }}"
                       required>
                @error('date_evenement')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Catégorie -->
            <div class="mb-3">
                <label class="form-label">Catégorie *</label>
                <select name="categorie_id" 
                        class="form-select @error('categorie_id') is-invalid @enderror" 
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
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Emplacement -->
            <div class="mb-3">
                <label class="form-label">Lieu *</label>
                <select name="emplacement_id" 
                        class="form-select @error('emplacement_id') is-invalid @enderror" 
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
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description" 
                          class="form-control @error('description') is-invalid @enderror" 
                          rows="4">{{ old('description', $evenement->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    {{ isset($evenement) ? 'Mettre à jour' : 'Créer' }}
                </button>
                <a href="{{ route('evenements.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection