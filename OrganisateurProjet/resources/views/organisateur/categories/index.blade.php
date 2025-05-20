@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Liste des Catégories</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-light">
            <i class="fas fa-plus-circle me-1"></i> Nouvelle Catégorie
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
                        <th>Événements associés</th>
                        <th>Créée le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->nom }}</td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $categorie->evenements_count }}
                            </span>
                        </td>
                        <td>{{ $categorie->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('categories.edit', $categorie->id) }}" 
                                   class="btn btn-sm btn-primary">
                                   <i class="fas fa-edit"></i>
                                </a>
                                
                                 <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-sm btn-danger"
                onclick="return confirm('Confirmer la suppression ?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucune catégorie trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $categories->links() }}
    </div>
</div>
@endsection