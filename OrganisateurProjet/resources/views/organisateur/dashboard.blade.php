<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-800 to-indigo-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex-1 mb-6 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-rocket mr-3"></i>Bienvenue sur Event Manager
                    </h1>
                    <p class="text-lg opacity-90">Plateforme de gestion d'événements professionnelle</p>
                </div>
                <div class="hidden md:block opacity-25">
                    <i class="fas fa-calendar-check text-6xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Quick Actions -->
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Accès rapide</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                    <a href="{{ route('organisateur.evenements.index') }}"
                       class="quick-action-btn bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all">
                        <div class="flex flex-col items-center">
                            <div class="icon-box bg-indigo-100 text-indigo-600 rounded-full p-4 mb-3">
                                <i class="fas fa-calendar-alt text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Gérer les Événements</h3>
                        </div>
                    </a>

                    
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="stats-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center">
                        <div class="icon-box bg-indigo-100 text-indigo-600 rounded-full p-3 mr-4">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Statistiques en temps réel</h3>
                            <p class="text-gray-600">Suivi des performances</p>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center">
                        <div class="icon-box bg-green-100 text-green-600 rounded-full p-3 mr-4">
                            <i class="fas fa-bell text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Notifications récentes</h3>
                            <p class="text-gray-600">Aucune alerte non lue</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Vos prochains événements</h2>
                </div>
                   
                </div>
            </div>
        </div>
    </div>

    <style>
        .quick-action-btn {
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0);
        }

        .quick-action-btn:hover {
            transform: translateY(-3px);
            border-color: rgba(159, 122, 234, 0.2);
        }

        .icon-box {
            transition: transform 0.3s ease;
        }

        .stats-card:hover .icon-box {
            transform: rotate(12deg) scale(1.1);
        }

        @media (max-width: 768px) {
            .quick-action-btn {
                width: 100%;
            }
        }
    </style>
</x-app-layout>
