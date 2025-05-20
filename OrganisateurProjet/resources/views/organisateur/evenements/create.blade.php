@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Créer un nouvel événement</h3>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('evenements.store') }}">
            @csrf

            <!-- Titre -->
            <div class="mb-3">
                <label class="form-label">Titre *</label>
                <input type="text" 
                       name="titre" 
                       class="form-control @error('titre') is-invalid @enderror" 
                       value="{{ old('titre') }}"
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
                       value="{{ old('date_evenement') }}"
                       min="{{ now()->format('Y-m-d\TH:i') }}"
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
                        {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Emplacement -->
            <div class="mb-4">
                <label class="form-label">Lieu *</label>
                <select name="emplacement_id" 
                        class="form-select @error('emplacement_id') is-invalid @enderror" 
                        required>
                    <option value="">Sélectionnez un lieu</option>
                    @foreach($emplacements as $emplacement)
                    <option value="{{ $emplacement->id }}" 
                        {{ old('emplacement_id') == $emplacement->id ? 'selected' : '' }}>
                        {{ $emplacement->nom }} ({{ $emplacement->adresse }})
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
                       rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>
                    Créer l'événement
                </button>
                <a href="{{ route('evenements.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection