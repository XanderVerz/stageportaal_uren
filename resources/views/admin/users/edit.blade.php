<x-layout>
    <div class="container mx-auto">
        <div class="flex justify-between items-center my-8">
            <h2 class="text-2xl font-semibold">Gebruiker Bewerken</h2>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
                Terug naar Gebruikers
            </a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Naam</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Bijwerken
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
