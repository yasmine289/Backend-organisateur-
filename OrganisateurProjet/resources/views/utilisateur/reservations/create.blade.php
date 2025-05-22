<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="md:flex">
            <!-- Event Info Section -->
            <div class="md:w-1/3 bg-gradient-to-br from-purple-900 to-amber-800 p-8 text-white">
                <h2 class="text-2xl font-bold mb-4">{{ $evenement->titre }}</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="far fa-calendar-alt mr-3 text-amber-300"></i>
                        <span>{{ $evenement->date_evenement->translatedFormat('l d F Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-3 text-amber-300"></i>
                        <span>{{ $evenement->date_evenement->format('H\hi') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-3 text-amber-300"></i>
                        <span>{{ $evenement->emplacement->nom }}</span>
                    </div>
                    <div class="pt-6 mt-6 border-t border-amber-300/30">
                        <p class="text-sm text-amber-200">Prix par ticket:</p>
                        <p class="text-2xl font-bold">
                            @if($evenement->prix_ticket > 0)
                                {{ number_format($evenement->prix_ticket, 2) }} €
                            @else
                                Entrée gratuite
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Reservation Form Section -->
            <div class="md:w-2/3 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Réservation</h2>

                <form method="POST" action="{{ route('reservations.store', $evenement) }}">
                    @csrf

                    <div class="mb-6">
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <input type="text" id="nom" name="nom"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                               required>
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                               required>
                    </div>

                    <div class="mb-8">
                        <label for="nombre_tickets" class="block text-sm font-medium text-gray-700 mb-2">Nombre de tickets</label>
                        <input type="number" id="nombre_tickets" name="nombre_tickets"
                               min="1" max="{{ $evenement->nombre_tickets }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                               required>
                        <p class="mt-2 text-sm text-gray-500">
                            {{ $evenement->nombre_tickets }} places disponibles
                        </p>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ url()->previous() }}" class="text-purple-600 hover:text-purple-800 font-medium">
                            Retour
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-amber-500 hover:from-purple-700 hover:to-amber-600 text-white font-bold rounded-lg shadow-md transition-all hover:shadow-lg">
                            Continuer vers le paiement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
