<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Événements à venir</h1>
                <p class="text-gray-600">Découvrez les prochains événements passionnants</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($evenements as $event)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Image de l'événement -->
                    <div class="h-48 bg-gradient-to-r from-purple-500 to-indigo-600 flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">{{ substr($event->titre, 0, 1) }}</span>
                    </div>

                    <div class="p-6">
                        <!-- Catégorie -->
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-indigo-600 bg-indigo-100 rounded-full mb-2">
                            {{ $event->categorie->nom }}
                        </span>

                        <!-- Titre -->
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->titre }}</h3>

                        <!-- Date et lieu -->
                        <div class="flex items-center text-gray-600 mb-4">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($event->date_evenement)->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center text-gray-600 mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $event->emplacement->nom }}</span>
                        </div>

                        <!-- Participants -->
                        <div class="flex -space-x-2">
                            @foreach($event->clients->take(5) as $client)
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-pink-500 to-yellow-500 flex items-center justify-center text-white text-xs font-bold">
                                    {{ $client->user ? substr($client->user->name, 0, 1) : '?' }}
                                </div>
                            @endforeach

                            @if($event->clients->count() > 5)
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-xs font-bold">
                                    +{{ $event->clients->count() - 5 }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $evenements->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
