
<x-app-layout>
<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0">Liste des Événements</h3>
            <small class="d-block mt-1">Gestion des événements, catégories et lieux</small>
        </div>
        <div class="d-flex gap-2">
           <a href="{{ route('organisateur.categories.index') }}" class="btn btn-warning">
    <i class="fas fa-tags me-1"></i> Catégories
</a>
            <a href="{{ route('organisateur.emplacements.index') }}" class="btn btn-secondary">
                <i class="fas fa-map-marker-alt me-1"></i> Lieux
            </a>
            <a href="{{ route('organisateur.evenements.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-1"></i> Nouvel Événement
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Catégorie</th>
                        <th>Lieu</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evenements as $evenement)
                    <tr>
                        <td>{{ $evenement->titre }}</td>
                        <td>{{ $evenement->date_evenement->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $evenement->categorie->nom ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $evenement->emplacement->nom ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                               <div class="d-flex gap-2">
                                <!-- Bouton Modifier -->
                                <a href="{{ route('organisateur.evenements.edit', $evenement->id) }}"
                                   class="btn btn-sm btn-primary">
                                   <i class="fas fa-edit"></i>
                                </a>

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('organisateur.evenements.destroy', $evenement->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer cet événement ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <!-- Bouton Utilisateurs/Clients -->
                                <a href="{{ route('organisateur.evenements.clients', $evenement->id) }}"
                                   class="btn btn-sm btn-info">
                                   <i class="fas fa-users"></i>
                                </a>

                                <!-- Bouton Paiements -->
                                <a href="{{ route('organisateur.evenements.paiements', $evenement->id) }}"
                                   class="btn btn-sm btn-success">
                                   <i class="fas fa-euro-sign"></i>
                                </a>


                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet élément ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    // Script pour gérer la suppression
    function confirmDelete(element) {
        const form = document.getElementById('deleteForm');
        form.action = element.dataset.deleteUrl;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endpush
</x-app-layout>
