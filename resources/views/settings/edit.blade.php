<x-layout>
    <x-slot name="pagetitle">
        Instellingen Bewerken
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Instellingen Bewerken</h1>

        <!-- Succesbericht na bewerkingen -->
        @if (session('success'))
            <div class="bg-green-200 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="post">
            @csrf
            @method('put')

            <!-- Starttijd standaard -->
            <div class="mb-4">
                <label for="start_tijd_standaard" class="block text-sm font-medium text-gray-600">Starttijd standaard</label>
                <input type="time" name="start_tijd_standaard" id="start_tijd_standaard" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Eindtijd standaard -->
            <div class="mb-4">
                <label for="eind_tijd_standaard" class="block text-sm font-medium text-gray-600">Eindtijd standaard</label>
                <input type="time" name="eind_tijd_standaard" id="eind_tijd_standaard" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Pauze standaard -->
            <div class="mb-4">
                <label for="pauze_standaard" class="block text-sm font-medium text-gray-600">Pauze standaard (in uren)</label>
                <input type="number" name="pauze_standaard" id="pauze_standaard" min="0" step="0.01" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Praktijkopleider -->
            <div class="mb-4">
                <label for="praktijkopleider" class="block text-sm font-medium text-gray-600">Praktijkopleider</label>
                <input type="text" name="praktijkopleider" id="praktijkopleider" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Stagebegeleider -->
            <div class="mb-4">
                <label for="stagebegeleider" class="block text-sm font-medium text-gray-600">Stagebegeleider</label>
                <input type="text" name="stagebegeleider" id="stagebegeleider" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            
            <!-- Leerbedrijf -->
            <div class="mb-4">
                <label for="leerbedrijf" class="block text-sm font-medium text-gray-600">Leerbedrijf</label>
                <input type="text" name="leerbedrijf" id="leerbedrijf" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Submit knop -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Bijwerken</button>
            </div>
        </form>
    </div>
</x-layout>
