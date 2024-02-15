<x-layout>
    <x-slot name="pagetitle">
        Instellingen Overzicht
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Instellingen Overzicht</h1>

        <!-- Toevoegen knop -->
      
        <!-- Overzichtstabel -->
        @if ($settings->isNotEmpty())
            <div class="bg-white border border-gray-300 p-4">
                <strong>Starttijd Standaard:</strong> {{ $settings->first()->start_tijd_standaard }}<br>
                <strong>Eindtijd Standaard:</strong> {{ $settings->first()->eind_tijd_standaard }}<br>
                <strong>Pauze Standaard:</strong> {{ $settings->first()->pauze_standaard }}<br>
                <strong>Praktijkopleider:</strong> {{ $settings->first()->praktijkopleider }}<br>
                <strong>Stagebegeleider:</strong> {{ $settings->first()->stagebegeleider }}<br>
                <strong>Leerbedrijf:</strong> {{ $settings->first()->leerbedrijf }}<br>
            </div>
        @else
            <p>Geen instellingen gevonden.</p> <br> <br>
            <a href="{{ route('settings.create') }}" class="bg-blue-500 text-white p-2 rounded-md">Toevoegen</a>
        @endif
    </div>
</x-layout>
