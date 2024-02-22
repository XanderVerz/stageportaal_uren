<x-layout>
    <x-slot name="pagetitle">
        Werkuren Overzicht
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Werkuren Overzicht</h1>

        <!-- Succesbericht na bewerkingen -->
        @if (session('success'))
            <div class="bg-green-200 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-200 p-2 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Toevoegen knop -->
        <div class="mb-4">
            <a href="{{ route('worked-hours.create') }}" class="bg-blue-500 text-white p-2 rounded-md">Toevoegen</a>
        </div>

        <!-- Overzichtstabel -->
        @if ($workedHours->isEmpty())
            <p>Geen gewerkte uren gevonden.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Datum</th>
                        <th class="py-2 px-4 border-b">Starttijd</th>
                        <th class="py-2 px-4 border-b">Eindtijd</th>
                        <th class="py-2 px-4 border-b">Pauze</th>
                        <th class="py-2 px-4 border-b">Gewerkte Uren</th>
                        <th class="py-2 px-4 border-b">Taken</th>
                        <th class="py-2 px-4 border-b">Bijzonderheden</th>
                        <th class="py-2 px-4 border-b">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workedHours as $workhour)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($workhour->datum)->format('d-m-Y') }}</td>
                            <td class="py-2 px-4 border-b">{{ $workhour->start_tijd }}</td>
                            <td class="py-2 px-4 border-b">{{ $workhour->eind_tijd }}</td>
                            <td class="py-2 px-4 border-b">{{ $workhour->pauze }}</td>
                            <td class="py-2 px-4 border-b">{{ $workhour->gewerkte_uren  }}</td>
                            <td class="py-2 px-4 border-b">{{ $workhour->taken }}</td>
                            <td class="py-2 px-4 border-b">{{ $workhour->bijzonderheden }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('worked-hours.edit', $workhour) }}" class="text-green-500 ml-2">Bewerken</a>
                                <form action="{{ route('worked-hours.destroy', $workhour) }}" method="post" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                       
                    @endforeach
                
              
                </tbody>
            </table>
        <div> <p class="text-lg font-semibold text-green-600">Totaal gewerkte uren: {{ $totalWorkedHours }} </p></div>
        <form method="GET" action="{{ route('generate.pdf') }}">
            <button type="submit" class="bg-green-500 text-white p-2 rounded-md">Genereer PDF</button>
        </form> 
        @endif

    </div>
</x-layout>
