<x-app-layout>
    <!-- Hero Slider -->
<div class="relative h-screen overflow-hidden">
    <div class="absolute inset-0 flex transition-transform duration-1000 ease-in-out" x-data="{
        currentSlide: 0,
        slides: [
            'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
        ],
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        }
    }" x-init="setInterval(() => { next() }, 5000)">
        <template x-for="(slide, index) in slides" :key="index">
            <div class="w-full h-full flex-shrink-0" x-show="currentSlide === index"
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <img :src="slide" class="w-full h-full object-cover"
                     :alt="'Event slide ' + (index + 1)"
                     loading="eager">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/70"></div>
            </div>
        </template>

        <!-- Navigation Arrows -->
        <button @click="prev()"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 text-white p-3 rounded-full hover:bg-white/30 transition backdrop-blur-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button @click="next()"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 text-white p-3 rounded-full hover:bg-white/30 transition backdrop-blur-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Indicators -->
        <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="currentSlide = index"
                        class="w-3 h-3 rounded-full transition-all duration-300"
                        :class="{ 'bg-amber-500 w-6': currentSlide === index, 'bg-white/50': currentSlide !== index }"></button>
            </template>
        </div>

        <!-- Hero Content -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-4 max-w-4xl transform transition-all duration-1000"
                 x-bind:style="{
                     'opacity': currentSlide === 0 ? '1' : '0.9',
                     'transform': currentSlide === 0 ? 'translateY(0)' : 'translateY(-10px)'
                 }">
                <!-- Message de bienvenue personnalisé -->
                @auth
                <div class="mb-6 animate-fade-in">
                    <p class="text-xl md:text-2xl text-amber-300 font-medium">Bienvenue, {{ Auth::user()->name }} 👋</p>
                </div>
                @endauth

                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in @auth delay-100 @endauth">Vivez des expériences inoubliables</h1>
                <p class="text-xl md:text-2xl text-white/90 mb-8 animate-fade-in @auth delay-200 @else delay-100 @endauth">Réservez vos places pour les événements les plus exclusifs de l'année</p>
                <a href="#events"
                   class="inline-flex items-center px-8 py-4 bg-amber-500 border border-transparent rounded-full font-bold text-white hover:bg-amber-600 transition transform hover:scale-105 animate-fade-in @auth delay-300 @else delay-200 @endauth">
                    Découvrir les événements
                    <i class="fas fa-arrow-down ml-3"></i>
                </a>
            </div>
        </div>
    </div>
</div>

    <!-- Value Propositions -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-semibold mb-4">POURQUOI NOUS CHOISIR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Une expérience événementielle exceptionnelle</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-all">
    <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-6">
        <i class="fas fa-star text-amber-600 text-2xl"></i>
    </div>
    <a href="{{ route('user.evenement.index') }}" class="block">
        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-amber-600 transition-colors">Événements Premium</h3>
    </a>
    <p class="text-gray-600">Accès aux événements les plus exclusifs et tendances de l'année, soigneusement sélectionnés pour vous.</p>
</div>

                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-lock text-amber-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Réservation Sécurisée</h3>
                    <p class="text-gray-600">Paiement 100% sécurisé avec confirmation immédiate et billetterie digitale pour un accès rapide.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-amber-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Conciergerie VIP</h3>
                    <p class="text-gray-600">Service client dédié 24/7 pour répondre à toutes vos demandes avant, pendant et après l'événement.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <div id="events" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold mb-4">NOS ÉVÉNEMENTS</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Découvrez nos prochains événements</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Réservez dès maintenant votre place pour vivre des moments uniques</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                @forelse($evenements as $event)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative h-80">
                        <img src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80' }}"
                             class="w-full h-full object-cover"
                             alt="{{ $event->titre }}">
                        <div class="absolute top-4 right-4 bg-white/90 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $event->categorie->nom ?? 'Premium' }}
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $event->titre }}</h3>
                                <div class="flex items-center text-gray-500 mb-4">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>{{ $event->emplacement->nom ?? 'Lieu exclusif' }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-amber-600">
                                    @if($event->prix > 0)
                                        {{ number_format($event->prix, 2) }} €
                                    @else
                                        Gratuit
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">par personne</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <i class="far fa-calendar-alt text-gray-400 mr-2"></i>
                                <span class="font-medium">
                                    @if($event->date_evenement instanceof \DateTime)
                                        {{ $event->date_evenement->format('d M Y, H:i') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($event->date_evenement)->format('d M Y, H:i') }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-400 mr-2"></i>
                                <span class="font-medium">{{ $event->clients_count }} participants</span>
                            </div>
                        </div>


                    </div>
                </div>
                @empty
                <div class="col-span-2 py-12 text-center">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-calendar-times text-5xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-700">Aucun événement à venir</h3>
                    <p class="text-gray-500 mt-2">Nos prochains événements seront bientôt annoncés</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="py-16 bg-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-white/20 rounded-full text-sm font-semibold mb-4">TÉMOIGNAGES</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ce que disent nos participants</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-amber-400 flex items-center justify-center text-xl font-bold mr-4">JD</div>
                        <div>
                            <h4 class="font-bold">Jean D.</h4>
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p>"Le concert était incroyable ! La réservation ultra simple et l'accès VIP en valait vraiment le coup. Je recommande à 100%."</p>
                </div>

                <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-amber-400 flex items-center justify-center text-xl font-bold mr-4">MS</div>
                        <div>
                            <h4 class="font-bold">Marie S.</h4>
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p>"Une expérience exceptionnelle du début à la fin. Le service client a répondu à toutes mes questions avant l'événement."</p>
                </div>

                <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-amber-400 flex items-center justify-center text-xl font-bold mr-4">TP</div>
                        <div>
                            <h4 class="font-bold">Thomas P.</h4>
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p>"La qualité des événements proposés est vraiment au top. J'ai déjà réservé pour le prochain festival!"</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal (AlpineJS) -->
    <div x-data="{
        showModal: false,
        selectedEvent: null,
        ticketQuantity: 1,
        openBookingModal(event) {
            this.selectedEvent = event;
            this.ticketQuantity = 1;
            this.showModal = true;
        },
        calculateTotal() {
            return this.selectedEvent ? (this.selectedEvent.prix * this.ticketQuantity).toFixed(2) : 0;
        }
    }" x-cloak>
        <!-- Modal Overlay -->
        <div x-show="showModal"
             class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            <!-- Modal Content -->
            <div x-show="showModal"
                 @click.away="showModal = false"
                 class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">

                <!-- Modal Header -->
                <div class="bg-gray-900 text-white p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold">Réserver vos places</h3>
                        <button @click="showModal = false" class="text-white/70 hover:text-white">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6" x-show="selectedEvent">
                    <div class="flex flex-col md:flex-row gap-6 mb-8">
                        <div class="flex-shrink-0">
                            <img :src="selectedEvent.image_url || 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'"
                                 class="w-40 h-40 rounded-xl object-cover">
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2" x-text="selectedEvent.titre"></h4>
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span x-text="new Date(selectedEvent.date_evenement).toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })"></span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span x-text="selectedEvent.emplacement?.nom || 'Lieu exclusif'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nombre de places</label>
                            <div class="flex items-center">
                                <button @click="ticketQuantity > 1 ? ticketQuantity-- : null"
                                        class="px-4 py-2 bg-gray-200 rounded-l-lg hover:bg-gray-300">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" x-model="ticketQuantity" min="1"
                                       class="w-16 text-center py-2 bg-gray-100 border-t border-b border-gray-200">
                                <button @click="ticketQuantity++"
                                        class="px-4 py-2 bg-gray-200 rounded-r-lg hover:bg-gray-300">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Prix unitaire</span>
                                <span class="font-medium" x-text="selectedEvent.prix > 0 ? selectedEvent.prix.toFixed(2) + ' €' : 'Gratuit'"></span>
                            </div>
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span x-text="calculateTotal() + ' €'" class="text-amber-600"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
                    <button @click="showModal = false"
                            class="px-6 py-2 text-gray-700 hover:text-gray-900 font-medium">
                        Annuler
                    </button>
                    <button class="px-6 py-2 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600">
                        Payer maintenant
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- AlpineJS & Tailwind Config -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] { display: none !important; }
        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        .animate-fade-in.delay-100 {
            animation-delay: 0.1s;
        }
        .animate-fade-in.delay-200 {
            animation-delay: 0.2s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>
