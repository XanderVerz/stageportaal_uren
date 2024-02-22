<x-layout>
    <div class="container mx-auto">
        <div class="flex justify-between items-center my-8">
            <h2 class="text-2xl font-semibold">Gebruikersbeheer</h2>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Voeg Gebruiker Toe
            </a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Naam</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">Rol</th>
                        <th class="border p-2">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="border p-2">{{ $user->id }}</td>
                            <td class="border p-2">{{ $user->name }}</td>
                            <td class="border p-2">{{ $user->email }}</td>
                            <td class="border p-2">{{ $user->role }}</td>

                            <td class="border p-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-2 py-1 rounded mr-2">
                                    Bewerken
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded">
                                        Verwijderen
                                    </button>
        
                                        </td>
                                        </form>
                                    </td>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
