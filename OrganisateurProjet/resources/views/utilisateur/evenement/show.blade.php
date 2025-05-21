<x-app-layout>
    <!-- Hero Section -->
    <div class="relative">
        <div class="h-96 w-full bg-gradient-to-r from-purple-600 to-indigo-700 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="relative z-10 text-center px-4">
                <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-full mb-4 text-sm font-medium">
                    {{ $evenement->categorie->nom }}
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $evenement->titre }}</h1>
                <div class="flex justify-center items-center space-x-4 text-white">
                    <div class="flex items-center">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>{{ $evenement->date_evenement->translatedFormat('l d F Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        <span>{{ $evenement->date_evenement->format('H\hi') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-20 relative z-20">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Event Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">
                <!-- Left Column -->
                <div class="lg:col-span-2">
                    <!-- Description -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-align-left text-indigo-500 mr-3"></i>
                            À propos de l'événement
                        </h2>
                        <div class="prose max-w-none text-gray-700">
                            <p class="text-lg leading-relaxed">{{ $evenement->description }}</p>
                        </div>
                    </div>

                    <!-- Gallery -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-images text-indigo-500 mr-3"></i>
                            Galerie
                        </h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @for($i = 1; $i <= 3; $i++)
                            <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-xl overflow-hidden">
                                <div class="w-full h-full bg-gradient-to-br from-purple-100 to-indigo-200 flex items-center justify-center">
                                    <i class="fas fa-camera text-gray-400 text-3xl"></i>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Right Column (Sidebar) -->
                <div class="space-y-6">
                    <!-- Location Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-indigo-500 mr-2"></i>
                            Lieu
                        </h3>
                        <div class="space-y-3">
                            <p class="text-gray-900 font-medium">{{ $evenement->emplacement->nom }}</p>
                            <p class="text-gray-600">{{ $evenement->emplacement->adresse }}</p>
                            <a href="#" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mt-2">
                                <i class="fas fa-directions mr-2"></i>
                                Voir sur la carte
                            </a>
                        </div>
                    </div>

                    <!-- Participants Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-users text-indigo-500 mr-2"></i>
                            Participants
                        </h3>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-3">
                                @forelse($evenement->clients->take(5) as $client)
    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-pink-500 to-yellow-500 flex items-center justify-center text-white font-bold shadow">
        {{ $client->user ? substr($client->user->name, 0, 1) : '?' }}
    </div>
@empty
    <p class="text-gray-500">Aucun participant</p>
@endforelse
                                @if($evenement->clients->count() > 5)
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold shadow">
                                    +{{ $evenement->clients->count() - 5 }}
                                </div>
                                @endif
                            </div>
                            <span class="text-gray-700 font-medium">{{ $evenement->clients->count() }} inscrits</span>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <button class="w-full py-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg transition-all transform hover:-translate-y-1">
                        S'inscrire à l'événement
                    </button>

                    <!-- Share Buttons -->
                    <div class="pt-4">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Partager</h4>
                        <div class="flex space-x-3">
                            <a href="#" class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="h-10 w-10 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="h-10 w-10 rounded-full bg-red-100 text-red-500 flex items-center justify-center hover:bg-red-200 transition">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organizer Info -->
            <div class="border-t border-gray-200 p-8 bg-gray-50">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Organisé par</h2>
                <div class="flex items-center">
                    <div class="h-16 w-16 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 flex items-center justify-center text-white font-bold text-2xl mr-4">
                        {{ substr($evenement->user->name ?? '?', 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $evenement->user->name ?? 'Organizer Unknown' }}</h3>
                        <p class="text-gray-600">
    @if($evenement->user)
        Organisateur depuis {{ $evenement->user->created_at->format('Y') }}
    @else
        Organisateur non spécifié
    @endif
</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <style>
        .prose {
            line-height: 1.75;
        }
        .prose p {
            margin-bottom: 1.25em;
        }
    </style>
</x-app-layout>
