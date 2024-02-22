<x-layout>
    <x-slot name="pagetitle">
        Werkuren Registreren
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Werkuren Registreren</h1>

        <form action="{{ route('worked-hours.store') }}" method="post">
            @csrf
            
            <!-- Datum -->
            <div class="mb-4">
                <label for="datum" class="block text-sm font-medium text-gray-600">Datum</label>
                <input type="date" name="datum" id="datum" value="{{ now()->format('Y-m-d') }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Starttijd -->
            <div class="mb-4">
                <label for="start_tijd" class="block text-sm font-medium text-gray-600">Starttijd</label>
                <input type="time" name="start_tijd" id="start_tijd" value="{{ old('start_tijd', optional($settings)->start_tijd_standaard) }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Eindtijd -->
            <div class="mb-4">
                <label for="eind_tijd" class="block text-sm font-medium text-gray-600">Eindtijd</label>
                <input type="time" name="eind_tijd" id="eind_tijd" value="{{ old('eind_tijd', optional($settings)->eind_tijd_standaard) }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Pauze -->
            <div class="mb-4">
                <label for="pauze" class="block text-sm font-medium text-gray-600">Pauze (in uren)</label>
                <input type="number" name="pauze" id="pauze" min="0" step="0.01" value="{{ old('pauze', optional($settings)->pauze_standaard) }}" class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Gewerkte uren (automatisch ingevuld) -->
            <div class="mb-4">
                <label for="gewerkte_uren" class="block text-sm font-medium text-gray-600">Gewerkte Uren</label>
                <input type="text" name="gewerkte_uren" id="gewerkte_uren" readonly class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Taken -->
            <div class="mb-4">
                <label for="taken" class="block text-sm font-medium text-gray-600">Taken</label>
                <textarea name="taken" id="taken" class="mt-1 p-2 w-full border rounded-md">{{ old('taken') }}</textarea>
            </div>

            <!-- Bijzonderheden -->
            <div class="mb-4">
                <label for="bijzonderheden" class="block text-sm font-medium text-gray-600">Bijzonderheden</label>
                <textarea name="bijzonderheden" id="bijzonderheden" class="mt-1 p-2 w-full border rounded-md">{{ old('bijzonderheden') }}</textarea>
            </div>

            <!-- Submit knop -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Opslaan</button>
            </div>
        </form>
    </div>

    <!-- JavaScript om gewerkte uren automatisch te berekenen -->
    <script>
        const startTijdInput = document.getElementById('start_tijd');
        const eindTijdInput = document.getElementById('eind_tijd');
        const pauzeInput = document.getElementById('pauze');
        const gewerkteUrenInput = document.getElementById('gewerkte_uren');

        function updateGewerkteUren() {
            const startTijdValue = startTijdInput.value || '{{ old('start_tijd', optional($settings)->start_tijd_standaard) }}';
            const eindTijdValue = eindTijdInput.value || '{{ old('eind_tijd', optional($settings)->eind_tijd_standaard) }}';
            const pauzeValue = pauzeInput.value || '{{ old('pauze', optional($settings)->pauze_standaard) }}';

            const startTijd = new Date(`2000-01-01 ${startTijdValue}`);
            const eindTijd = new Date(`2000-01-01 ${eindTijdValue}`);
            const pauze = parseFloat(pauzeValue) || 0;

            const verschilInUren = ((eindTijd - startTijd) / (1000 * 60 * 60)) - pauze;

            const gewerkteUren = verschilInUren >= 0 ? verschilInUren.toFixed(2) : 0;

            gewerkteUrenInput.value = gewerkteUren;

            gewerkteUrenInput.classList.remove('border', 'border-red-500');
        }

        // Roep de functie aan bij het laden van de pagina om het initiële resultaat in te vullen
        updateGewerkteUren();
        startTijdInput.addEventListener('input', updateGewerkteUren);
        eindTijdInput.addEventListener('input', updateGewerkteUren);
        pauzeInput.addEventListener('input', updateGewerkteUren);
    </script>
</x-layout>
