<x-app-layout>
    <div class="relative bg-gradient-to-r from-purple-900 to-indigo-800 text-white py-20">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-fade-in">Nos Événements Exclusifs</h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto animate-fade-in delay-100">
                    Découvrez des expériences uniques soigneusement sélectionnées pour vous
                </p>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <h2 class="text-2xl font-bold text-gray-900">Trouver des événements</h2>
                    <form method="GET" action="{{ route('user.evenement.index') }}" class="w-full md:w-auto">
                        <div class="flex flex-col md:flex-row flex-wrap gap-4 w-full">
                            <div class="relative flex-grow">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" placeholder="Rechercher un événement..."
                                        class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        value="{{ request('search') }}">
                            </div>

                            <select name="location" class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Tous les emplacements</option>
                                @isset($emplacements)
                                    @foreach($emplacements as $emplacement)
                                        <option value="{{ $emplacement->id }}" {{ request('location') == $emplacement->id ? 'selected' : '' }}>
                                            {{ $emplacement->nom }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>

                            <select name="category" class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Toutes catégories</option>
                                @isset($categories)
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nom }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>

                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($evenements as $event)
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col">
                    <div class="relative">
                        <img class="h-48 w-full object-cover" src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80' }}" alt="{{ $event->titre }}">
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                {{ $event->categorie->nom ?? 'Général' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ \Carbon\Carbon::parse($event->date_evenement)->translatedFormat('d M Y, H:i') }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->titre }}</h3>

                        <div class="flex items-center text-gray-600 mb-4">
                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                            <span>{{ $event->emplacement->nom ?? 'Lieu inconnu' }}</span>
                        </div>

                        {{-- Section pour le prix et le nombre de tickets disponibles --}}
                        <div class="flex items-center justify-between text-lg font-bold mb-4">
                            <span class="text-amber-600">
    @if(isset($event->prix_ticket) && $event->prix_ticket > 0)
        {{ number_format($event->prix_ticket, 2) }} €
    @else
        Gratuit
    @endif
</span>

<span class="text-gray-700">
    {{ $event->nombre_tickets }} places
</span>
                        </div>

                        {{-- Barre de progression des tickets --}}
                        <div class="mb-4 mt-auto">
                            @php
                                // Assurez-vous que $event->reservations_count est bien défini et représente le nombre de tickets réservés
                                $reservations_count = $event->reservations_count ?? 0;
                                $pourcentage_reserve = ($event->nbticket > 0) ? ($reservations_count / $event->nbticket) * 100 : 0;
                            @endphp
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>{{ $reservations_count }} réservations</span>
                                <span>{{ $event->nbticket - $reservations_count }} restantes</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $pourcentage_reserve }}%;"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <a href="{{ route('user.evenement.show', $event->id) }}" class="px-6 py-3 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition flex items-center justify-center w-full">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Réserver
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-calendar-times text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-700">Aucun événement trouvé</h3>
                        <p class="text-gray-500 mt-2">Ajustez vos filtres ou revenez plus tard pour découvrir de nouveaux événements.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {{ $evenements->links() }}
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-purple-900 to-indigo-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Prêt à vivre une expérience inoubliable ?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Inscrivez-vous pour recevoir nos offres exclusives en avant-première</p>
            <div class="max-w-md mx-auto flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Votre email" class="px-4 py-3 rounded-lg flex-grow text-gray-900">
                <button class="px-6 py-3 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition">
                    S'inscrire
                </button>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }
        .animate-fade-in.delay-100 {
            animation-delay: 0.1s;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .shadow-lg {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</x-app-layout>
