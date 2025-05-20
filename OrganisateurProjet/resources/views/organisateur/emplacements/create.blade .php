@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-secondary text-white">
        <h3 class="mb-0">{{ isset($emplacement) ? 'Modifier' : 'Créer' }} un Lieu</h3>
    </div>

    <div class="card-body">
        <form method="POST" 
              action="{{ isset($emplacement) ? route('emplacements.update', $emplacement->id) : route('emplacements.store') }}">
            @csrf
            @isset($emplacement) @method('PUT') @endisset

            <div class="mb-3">
                <label class="form-label">Nom *</label>
                <input type="text" 
                       name="nom" 
                       class="form-control @error('nom') is-invalid @enderror" 
                       value="{{ old('nom', $emplacement->nom ?? '') }}"
                       required>
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Adresse *</label>
                <input type="text" 
                       name="adresse" 
                       class="form-control @error('adresse') is-invalid @enderror" 
                       value="{{ old('adresse', $emplacement->adresse ?? '') }}"
                       required>
                @error('adresse')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    {{ isset($emplacement) ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('emplacements.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection