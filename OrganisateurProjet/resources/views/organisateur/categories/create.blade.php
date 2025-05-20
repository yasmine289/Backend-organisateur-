@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-white">
        <h3 class="mb-0">Créer une nouvelle catégorie</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nom de la catégorie *</label>
                <input type="text" 
                       name="nom" 
                       class="form-control @error('nom') is-invalid @enderror" 
                       value="{{ old('nom') }}"
                       required>
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    Enregistrer
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection