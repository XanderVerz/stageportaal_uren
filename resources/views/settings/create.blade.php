
<x-layout>
    <x-slot name="pagetitle">
        Instellingen Toevoegen
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Instellingen Toevoegen</h1>

        <!-- Formulier voor het toevoegen van instellingen -->
        <form action="{{ route('settings.store') }}" method="post">
            @csrf

            <!-- Starttijd standaard -->
            <div class="mb-4">
                <label for="start_tijd_standaard" class="block text-sm font-medium text-gray-600">Starttijd standaard</label>
                <input type="time" name="start_tijd_standaard" id="start_tijd_standaard" value="{{ old('start_tijd_standaard') }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Eindtijd standaard -->
            <div class="mb-4">
                <label for="eind_tijd_standaard" class="block text-sm font-medium text-gray-600">Eindtijd standaard</label>
                <input type="time" name="eind_tijd_standaard" id="eind_tijd_standaard" value="{{ old('eind_tijd_standaard') }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Pauze standaard -->
            <div class="mb-4">
                <label for="pauze_standaard" class="block text-sm font-medium text-gray-600">Pauze standaard (in uren)</label>
                <input type="number" name="pauze_standaard" id="pauze_standaard" min="0" step="0.01" value="{{ old('pauze_standaard') }}" class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Praktijkopleider -->
            <div class="mb-4">
                <label for="praktijkopleider" class="block text-sm font-medium text-gray-600">Praktijkopleider</label>
                <input type="text" name="praktijkopleider" id="praktijkopleider" value="{{ old('praktijkopleider') }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Stagebegeleider -->
            <div class="mb-4">
                <label for="stagebegeleider" class="block text-sm font-medium text-gray-600">Stagebegeleider</label>
                <input type="text" name="stagebegeleider" id="stagebegeleider" value="{{ old('stagebegeleider') }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Leerbedrijf -->
            <div class="mb-4">
                <label for="leerbedrijf" class="block text-sm font-medium text-gray-600">Leerbedrijf</label>
                <input type="text" name="leerbedrijf" id="leerbedrijf" value="{{ old('leerbedrijf') }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Submit knop -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Toevoegen</button>
            </div>
        </form>
    </div>
</x-layout>
