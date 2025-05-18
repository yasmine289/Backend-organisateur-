<x-app-layout>
    <!-- Hero Section with Image Carousel -->
    <div class="relative h-96 overflow-hidden">
        <!-- Carousel Container -->
        <div class="absolute inset-0 flex transition-transform duration-1000 ease-in-out" x-data="{ currentSlide: 0, slides: [
            'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'https://images.unsplash.com/photo-1531058020387-3be344556be6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
        ] }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % slides.length }, 5000)">
            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div class="w-full h-full flex-shrink-0" x-show="currentSlide === index" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <img :src="slide" class="w-full h-full object-cover" :alt="'Event slide ' + (index + 1)">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center px-4">
                            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Bienvenue, <span class="text-indigo-300">{{ Auth::user()->name }}</span> 👋</h1>
                            <p class="text-xl text-white opacity-90">Découvrez votre espace événements personnalisé</p>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Carousel Indicators -->
            <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index" class="w-3 h-3 rounded-full" :class="{ 'bg-white': currentSlide === index, 'bg-white/50': currentSlide !== index }"></button>
                </template>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all hover:scale-105">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            <i class="fas fa-calendar-alt text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Événements créés</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->evenements_count }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all hover:scale-105">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Participants total</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->evenements->sum('clients_count') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all hover:scale-105">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-ticket-alt text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Prochains événements</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->evenements()->where('date_evenement', '>', now())->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <a href="{{ route('evenements.index') }}" class="group relative overflow-hidden rounded-xl shadow-lg h-48 bg-gradient-to-r from-purple-500 to-indigo-600 text-white transform transition-all hover:scale-105">
                    <div class="absolute inset-0 flex flex-col justify-center items-center p-6 z-10">
                        <div class="p-3 rounded-full bg-white/20 mb-4">
                            <i class="fas fa-calendar-plus text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Mes Événements</h3>
                        <p class="text-center text-white/90">Gérez tous vos événements</p>
                    </div>
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-all"></div>
                </a>

                <a href="{{ route('categories.index') }}" class="group relative overflow-hidden rounded-xl shadow-lg h-48 bg-gradient-to-r from-green-500 to-teal-600 text-white transform transition-all hover:scale-105">
                    <div class="absolute inset-0 flex flex-col justify-center items-center p-6 z-10">
                        <div class="p-3 rounded-full bg-white/20 mb-4">
                            <i class="fas fa-tags text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Mes Catégories</h3>
                        <p class="text-center text-white/90">Organisez vos catégories</p>
                    </div>
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-all"></div>
                </a>

                <a href="{{ route('profile.edit') }}" class="group relative overflow-hidden rounded-xl shadow-lg h-48 bg-gradient-to-r from-blue-500 to-cyan-600 text-white transform transition-all hover:scale-105">
                    <div class="absolute inset-0 flex flex-col justify-center items-center p-6 z-10">
                        <div class="p-3 rounded-full bg-white/20 mb-4">
                            <i class="fas fa-cog text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Paramètres</h3>
                        <p class="text-center text-white/90">Personnalisez votre compte</p>
                    </div>
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-all"></div>
                </a>
            </div>

            <!-- Upcoming Events -->
            <div class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Vos prochains événements</h2>
                    <a href="{{ route('evenements.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                        Voir tout <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse(Auth::user()->evenements()->where('date_evenement', '>', now())->orderBy('date_evenement')->take(3)->get() as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all hover:scale-[1.02] hover:shadow-xl">
                        <div class="h-48 bg-gradient-to-r from-purple-400 to-indigo-500 flex items-center justify-center relative">
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                <span class="text-white text-5xl font-bold">{{ substr($event->titre, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-indigo-600 bg-indigo-100 rounded-full mb-3">
                                {{ $event->categorie->nom }}
                            </span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->titre }}</h3>
                            <div class="flex items-center text-gray-600 mb-3">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>{{ $event->date_evenement->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center text-gray-600 mb-4">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>{{ $event->emplacement->nom }}</span>
                            </div>
                            <div class="flex justify-between items-center">
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
                                <span class="text-sm text-gray-500">{{ $event->clients->count() }} participants</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 py-12 text-center">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-calendar-times text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-700">Aucun événement à venir</h3>
                        
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Activité récente</h3>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-full">Tout</button>
                        <button class="px-3 py-1 text-sm bg-indigo-100 text-indigo-700 rounded-full">Événements</button>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-start">
                            <div class="p-2 rounded-full bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="text-gray-800">Vous avez créé l'événement <strong>Conférence Tech</strong></p>
                                <p class="text-sm text-gray-500 mt-1">Il y a 2 jours</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-start">
                            <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <p class="text-gray-800"><strong>15 participants</strong> se sont inscrits à <strong>Concert d'été</strong></p>
                                <p class="text-sm text-gray-500 mt-1">Il y a 5 jours</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AlpineJS for Carousel -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>
