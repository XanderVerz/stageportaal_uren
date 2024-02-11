<x-layout>
    <x-slot name="pagetitle">
        Werkuren Bewerken
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Werkuren Bewerken</h1>

        <!-- Succesbericht na bewerkingen -->
        @if (session('success'))
            <div class="bg-green-200 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('worked-hours.update', $workedHour) }}" method="post">
            @csrf
            @method('put')

            <!-- Datum -->
            <div class="mb-4">
                <label for="datum" class="block text-sm font-medium text-gray-600">Datum</label>
                <input type="date" name="datum" id="datum" value="{{ old('datum', $workedHour->datum) }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Starttijd -->
            <div class="mb-4">
                <label for="start_tijd" class="block text-sm font-medium text-gray-600">Starttijd</label>
                <input type="time" name="start_tijd" id="start_tijd" value="{{ old('start_tijd', $workedHour->start_tijd) }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Eindtijd -->
            <div class="mb-4">
                <label for="eind_tijd" class="block text-sm font-medium text-gray-600">Eindtijd</label>
                <input type="time" name="eind_tijd" id="eind_tijd" value="{{ old('eind_tijd', $workedHour->eind_tijd) }}" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Pauze -->
            <div class="mb-4">
                <label for="pauze" class="block text-sm font-medium text-gray-600">Pauze (in uren)</label>
                <input type="number" name="pauze" id="pauze" min="0" step="0.01" value="{{ old('pauze', $workedHour->pauze) }}" class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Gewerkte uren (automatisch ingevuld) -->
            <div class="mb-4">
                <label for="gewerkte_uren" class="block text-sm font-medium text-gray-600">Gewerkte Uren</label>
                <input type="text" name="gewerkte_uren" id="gewerkte_uren" value="{{ old('gewerkte_uren', $workedHour->gewerkte_uren) }}" readonly class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Taken -->
            <div class="mb-4">
                <label for="taken" class="block text-sm font-medium text-gray-600">Taken</label>
                <textarea name="taken" id="taken" class="mt-1 p-2 w-full border rounded-md">{{ old('taken', $workedHour->taken) }}</textarea>
            </div>

            <!-- Bijzonderheden -->
            <div class="mb-4">
                <label for="bijzonderheden" class="block text-sm font-medium text-gray-600">Bijzonderheden</label>
                <textarea name="bijzonderheden" id="bijzonderheden" class="mt-1 p-2 w-full border rounded-md">{{ old('bijzonderheden', $workedHour->bijzonderheden) }}</textarea>
            </div>

            <!-- Submit knop -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Bijwerken</button>
            </div>
        </form>
    </div>
</x-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startTijdInput = document.getElementById('start_tijd');
        const eindTijdInput = document.getElementById('eind_tijd');
        const pauzeInput = document.getElementById('pauze');
        const gewerkteUrenInput = document.getElementById('gewerkte_uren');

        function updateGewerkteUren() {
            const startTijd = new Date(`2000-01-01 ${startTijdInput.value}`);
            const eindTijd = new Date(`2000-01-01 ${eindTijdInput.value}`);
            const pauze = parseFloat(pauzeInput.value) || 0; // Zorg ervoor dat pauze 0 is als het niet-numeriek is
            const verschilInUren = ((eindTijd - startTijd) / (1000 * 60 * 60)) - pauze;

            // Controleer of het verschil in uren positief is voordat je de waarde toewijst
            const gewerkteUren = verschilInUren >= 0 ? verschilInUren.toFixed(2) : 0;

            // Vul het gewerkte_uren veld in met het berekende getal
            gewerkteUrenInput.value = gewerkteUren;

            // Optioneel: Verwijder de voorgaande invalid-klasse als die er is
            gewerkteUrenInput.classList.remove('border', 'border-red-500');
        }

        startTijdInput.addEventListener('input', updateGewerkteUren);
        eindTijdInput.addEventListener('input', updateGewerkteUren);
        pauzeInput.addEventListener('input', updateGewerkteUren);

        // Voer de functie bij het laden van de pagina uit om het initiële resultaat in te vullen
        updateGewerkteUren();
    });
</script>