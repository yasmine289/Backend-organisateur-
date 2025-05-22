<x-app-layout>
    <!-- Hero Section with Parallax Effect -->
    <div class="relative h-[32rem] w-full overflow-hidden group">
        <!-- Parallax Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900 to-amber-800 transform group-hover:scale-105 transition-transform duration-1000 ease-out">
            <img src="https://source.unsplash.com/random/1600x900/?event,concert,party"
                 alt="{{ $evenement->titre }}"
                 class="w-full h-full object-cover mix-blend-overlay opacity-30 transform group-hover:scale-110 transition-transform duration-1000 ease-out">
        </div>

        <!-- Animated Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent"></div>

        <!-- Content with Fade-in Animation -->
        <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-8 animate-fade-in">
            <div class="max-w-4xl mx-auto w-full text-center space-y-6">
                <span class="inline-block px-4 py-2 bg-amber-400/90 text-gray-900 rounded-full text-sm font-bold tracking-wider shadow-md hover:scale-105 transition-transform">
                    {{ $evenement->categorie->nom }}
                </span>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-2 leading-tight drop-shadow-lg animate-slide-up">
                    {{ $evenement->titre }}
                </h1>

                <div class="flex flex-wrap justify-center items-center gap-4 text-white/95 text-lg animate-slide-up delay-100">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full hover:bg-white/20 transition-all">
                        <i class="far fa-calendar-alt mr-2 text-amber-300"></i>
                        <span>{{ $evenement->date_evenement->translatedFormat('l d F Y') }}</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full hover:bg-white/20 transition-all">
                        <i class="far fa-clock mr-2 text-amber-300"></i>
                        <span>{{ $evenement->date_evenement->format('H\hi') }}</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full hover:bg-white/20 transition-all">
                        <i class="fas fa-map-marker-alt mr-2 text-amber-300"></i>
                        <span>{{ $evenement->emplacement->nom }}</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full hover:bg-white/20 transition-all">
                        <i class="fas fa-ticket-alt mr-2 text-amber-300"></i>
                        <span class="text-purple-50">Prix</span>
                                            @if($evenement->prix_ticket > 0)
                                                {{ number_format($evenement->prix_ticket, 2) }} €
                                            @else
                                                Entrée gratuite
                                            @endif
                                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-20">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Left Column -->
            <div class="lg:w-2/3 space-y-10">
                <!-- About Section with Floating Effect -->
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex items-center mb-8">
                        <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-purple-500 to-amber-500 flex items-center justify-center text-white mr-4 shadow-lg">
                            <i class="fas fa-info-circle text-xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-amber-500">
                            À propos de l'événement
                        </h2>
                    </div>
                    <div class="prose max-w-none">
                        <p class="text-gray-800 leading-relaxed animate-fade-in delay-200">{{ $evenement->description }}</p>
                    </div>
                </div>

                <!-- Organizer Section with Hover Animation -->
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 border border-gray-100 hover:-translate-y-1 transition-transform">
                    <div class="flex items-center mb-8">
                        <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-purple-500 to-amber-500 flex items-center justify-center text-white mr-4 shadow-lg">
                            <i class="fas fa-user-tie text-xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-amber-500">
                            Organisé par
                        </h2>
                    </div>
                    <div class="flex items-center bg-white/80 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-20 w-20 rounded-full bg-gradient-to-r from-purple-600 to-amber-500 flex items-center justify-center text-white font-bold text-3xl mr-6 shadow-lg hover:rotate-6 transition-transform">
                            {{ substr($evenement->organisateur->name ?? $evenement->user->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 animate-fade-in">
                                {{ $evenement->organisateur->name ?? $evenement->user->name ?? 'Organisateur inconnu' }}
                            </h3>
                            <p class="text-gray-600 mt-2">
                                @if($evenement->organisateur ?? $evenement->user)
                                    <span class="inline-block bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-semibold animate-pulse">
                                        Organise depuis {{ ($evenement->organisateur->created_at ?? $evenement->user->created_at)->format('Y') }}
                                    </span>
                                @else
                                    <span class="text-gray-500 text-sm">Informations non disponibles</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="lg:w-1/3">
                <div class="sticky top-8 space-y-8">
                    <!-- Register Card with Pulse Animation -->
                    <div class="bg-gradient-to-br from-purple-900 to-purple-700 rounded-2xl shadow-2xl overflow-hidden animate-float">
                        <div class="px-8 py-6">
                            <h3 class="text-2xl font-bold text-white mb-2">Réservez votre place</h3>
                            <p class="text-purple-100 mb-6">Ne manquez pas cet événement exceptionnel</p>

                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-purple-50">Prix</span>
                                    <span class="font-bold text-white text-xl">

                                            @if($evenement->prix_ticket > 0)
                                                {{ number_format($evenement->prix_ticket, 2) }} €
                                            @else
                                                Entrée gratuite
                                            @endif

                                    </span>
                                </div>
                            </div>

                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-50">Places disponibles</span>
                                    <span class="font-bold text-white text-xl">

                                            {{ $evenement->nombre_tickets > 0 ? $evenement->nombre_tickets - $evenement->reservations_count : 0 }} places restantes
                                        </span>
                                </div>
                                <div class="w-full bg-gray-300 rounded-full h-2.5 mt-3">
                                    <div class="bg-amber-400 h-2.5 rounded-full"
                                         style="width: {{ $evenement->nbticket > 0 ? ($evenement->reservations_count / $evenement->nbticket) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('reservations.create', $evenement) }}"
   class="w-full py-4 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-gray-900 font-bold rounded-xl shadow-lg transition-all hover:shadow-amber-300/50 hover:scale-[1.02] flex items-center justify-center">
    <i class="fas fa-ticket-alt mr-3 animate-bounce"></i>
    S'inscrire maintenant
</a>
                        </div>
                    </div>

                    <!-- Event Details Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 hover:shadow-2xl transition-shadow">
                        <div class="flex items-center mb-6">
                            <div class="h-10 w-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mr-3 shadow-sm">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Détails de l'événement
                            </h3>
                        </div>

                        <div class="space-y-5">
                            <div class="flex items-start group">
                                <div class="h-10 w-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center mr-3 flex-shrink-0 group-hover:rotate-12 transition-transform">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Date et heure</h4>
                                    <p class="text-gray-900 font-medium">
                                        {{ $evenement->date_evenement->translatedFormat('l d F Y') }}<br>
                                        <span class="text-amber-600 font-semibold">à {{ $evenement->date_evenement->format('H\hi') }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div class="h-10 w-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mr-3 flex-shrink-0 group-hover:-rotate-12 transition-transform">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Lieu</h4>
                                    <p class="text-gray-900 font-medium">{{ $evenement->emplacement->nom }}</p>
                                    <p class="text-gray-600 text-sm">{{ $evenement->emplacement->adresse }}</p>
                                    <a href="#" class="inline-flex items-center text-purple-600 text-sm mt-1 hover:text-purple-800 font-medium group">
                                        <i class="fas fa-directions mr-1 group-hover:translate-x-1 transition-transform"></i>
                                        Itinéraire
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div class="h-10 w-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center mr-3 flex-shrink-0 group-hover:rotate-12 transition-transform">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Disponibilité</h4>
                                    <p class="text-gray-900 font-medium">
                                        <span class="text-green-600 font-semibold">
                                            @if($evenement->prix_ticket > 0)
                                                {{ number_format($evenement->prix_ticket, 2) }} €
                                            @else
                                                Entrée gratuite
                                            @endif
                                        </span>
                                        <br>
                                        <span class="text-sm text-gray-600">
                                            {{ $evenement->nombre_tickets > 0 ? $evenement->nombre_tickets - $evenement->reservations_count : 0 }} places restantes
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participants Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 hover:shadow-2xl transition-shadow">
                        <div class="flex items-center mb-6">
                            <div class="h-10 w-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mr-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Participants ({{ $evenement->reservations_count }})
                            </h3>
                        </div>

                        <div class="flex flex-wrap gap-3 mb-4">
                            @forelse($evenement->reservations->take(15) as $reservation)
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-purple-500 to-amber-400 flex items-center justify-center text-white font-bold shadow-sm hover:scale-125 transition-transform duration-300 hover:z-10">
                                {{ $reservation->user ? substr($reservation->user->name, 0, 1) : '?' }}
                            </div>
                            @empty
                            <p class="text-gray-500 text-sm">Soyez le premier à vous inscrire!</p>
                            @endforelse
                        </div>

                        @if($evenement->reservations_count > 15)
                        <div class="text-center mt-3">
                            <span class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-gray-200 transition">
                                +{{ $evenement->reservations_count - 15 }} autres
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Share Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 hover:shadow-2xl transition-shadow">
                        <div class="flex items-center mb-6">
                            <div class="h-10 w-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mr-3">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Partagez cet événement
                            </h3>
                        </div>

                        <div class="grid grid-cols-3 gap-3">
                            <a href="#" class="py-3 bg-blue-600 text-white rounded-lg text-center hover:bg-blue-700 transition flex items-center justify-center hover:-translate-y-1 shadow-md hover:shadow-lg">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="py-3 bg-blue-400 text-white rounded-lg text-center hover:bg-blue-500 transition flex items-center justify-center hover:-translate-y-1 shadow-md hover:shadow-lg">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="py-3 bg-red-500 text-white rounded-lg text-center hover:bg-red-600 transition flex items-center justify-center hover:-translate-y-1 shadow-md hover:shadow-lg">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                            <a href="#" class="py-3 bg-green-500 text-white rounded-lg text-center hover:bg-green-600 transition flex items-center justify-center hover:-translate-y-1 shadow-md hover:shadow-lg">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="py-3 bg-gray-800 text-white rounded-lg text-center hover:bg-gray-900 transition flex items-center justify-center hover:-translate-y-1 shadow-md hover:shadow-lg">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="py-3 bg-pink-600 text-white rounded-lg text-center hover:bg-pink-700 transition flex items-center justify-center hover:-translate-y-1 shadow-md hover:shadow-lg">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        @keyframes progress {
            from { width: 0; }
            to { width: 100%; }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-slide-up {
            animation: slideUp 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-progress {
            animation: progress 1.5s ease-out forwards;
        }

        /* Enhanced Prose Styling */
        .prose {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #374151;
        }

        .prose p {
            margin-bottom: 1.4em;
            position: relative;
        }

        .prose p::after {
            content: "";
            display: block;
            width: 40px;
            height: 3px;
            background: linear-gradient(to right, #8B5CF6, #F59E0B);
            margin-top: 1em;
            opacity: 0.3;
        }

        .prose p:last-child::after {
            display: none;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8B5CF6, #F59E0B);
            border-radius: 10px;
        }
    </style>
</x-app-layout>
