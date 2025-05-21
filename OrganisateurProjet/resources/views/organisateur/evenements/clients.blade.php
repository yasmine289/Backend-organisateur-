<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <!-- Titre -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                👥 Liste des participants
            </h1>
            <p class="text-gray-600 mt-1">
                Événement : <span class="font-semibold text-indigo-600">{{ $evenement->titre }}</span>
            </p>
        </div>

        <!-- Table des clients -->
        @if ($evenement->clients->isEmpty())
            <div class="alert alert-warning bg-yellow-100 text-yellow-800 p-4 rounded">
                Aucun client n’a encore participé à cet événement.
            </div>
        @else
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nom</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                            <!-- Ajoute plus de colonnes si tu veux -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($evenement->clients as $client)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $client->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $client->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Bouton retour -->
        <div class="mt-6">
            <a href="{{ route('organisateur.evenements.index') }}" 
               class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded transition">
                ← Retour aux événements
            </a>
        </div>

    </div>
</x-app-layout>
