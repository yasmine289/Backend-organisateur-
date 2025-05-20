<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Événements à venir</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($evenements as $event)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition">
    <div class="p-6">
        <h3 class="font-medium text-lg mb-2">{{ $event->titre }}</h3>
        <p class="text-gray-600 mb-2">
            <i class="far fa-calendar-alt mr-2"></i>
            @if($event->date_evenement instanceof \DateTime)
                {{ $event->date_evenement->format('d/m/Y H:i') }}
            @else
                {{ \Carbon\Carbon::parse($event->date_evenement)->format('d/m/Y H:i') }}
            @endif
        </p>
        <p class="text-gray-600 mb-4">
            <i class="fas fa-map-marker-alt mr-2"></i>
            {{ $event->emplacement->nom ?? 'Non spécifié' }}
        </p>
    </div>
</div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Aucun événement à venir pour le moment</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('user.evenement.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                    Voir tous les événements
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
