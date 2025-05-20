@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Gestion des Lieux</h3>
        <a href="{{ route('emplacements.create') }}" class="btn btn-light">
            <i class="fas fa-plus-circle me-1"></i> Nouveau Lieu
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emplacements as $emplacement)
                    <tr>
                        <td>{{ $emplacement->nom }}</td>
                        <td>{{ $emplacement->adresse }}</td>
                        <td>{{ $emplacement->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('emplacements.edit', $emplacement->id) }}" 
                                   class="btn btn-sm btn-primary">
                                   <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('emplacements.destroy', $emplacement->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer ce lieu ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucun lieu enregistré</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection