<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <!-- Bannière -->
                <div class="h-64 bg-gradient-to-r from-purple-500 to-indigo-600 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                        <h1 class="text-4xl font-bold text-white">{{ $evenement->titre }}</h1>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="p-8">
                    <!-- En-tête -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                        <div>
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full mb-2">
                                {{ $evenement->categorie->nom }}
                            </span>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $evenement->titre }}</h2>
                        </div>
                        <div class="mt-4 md:mt-0 text-right">
                            <div class="text-lg font-semibold text-gray-900">{{ $evenement->date_evenement->format('d M Y') }}</div>
                            <div class="text-gray-600">{{ $evenement->date_evenement->format('H:i') }}</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none mb-8">
                        <p class="text-gray-700">{{ $evenement->description }}</p>
                    </div>

                    <!-- Infos pratiques -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-map-marker-alt text-indigo-500 mr-2"></i>
                                Lieu
                            </h3>
                            <p class="text-gray-700">{{ $evenement->emplacement->nom }}</p>
                            <p class="text-gray-600">{{ $evenement->emplacement->adresse }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-users text-indigo-500 mr-2"></i>
                                Participants
                            </h3>
                            <div class="flex items-center">
                                <div class="flex -space-x-2 mr-3">
                                    @foreach($evenement->clients->take(5) as $client)
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-pink-500 to-yellow-500 flex items-center justify-center text-white text-xs font-bold">
                                        {{ substr($client->user->name, 0, 1) }}
                                    </div>
                                    @endforeach
                                </div>
                                <span class="text-gray-700">{{ $evenement->clients->count() }} inscrits</span>
                            </div>
                        </div>
                    </div>

                    <!-- Galerie (optionnel) -->
                    <div class="mb-8">
                        <h3 class="font-semibold text-gray-900 mb-4">Galerie</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="h-32 bg-gray-200 rounded-lg"></div>
                            <div class="h-32 bg-gray-200 rounded-lg"></div>
                            <div class="h-32 bg-gray-200 rounded-lg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
