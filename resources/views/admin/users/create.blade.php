<x-layout>
    <div class="container mx-auto">
        <div class="flex justify-between items-center my-8">
            <h2 class="text-2xl font-semibold">Nieuwe Gebruiker Toevoegen</h2>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
                Terug naar Gebruikers
            </a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Naam</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Wachtwoord</label>
                    <input type="password" name="password" id="password" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-600">Rol</label>
                    <select name="role" id="role" class="mt-1 p-2 w-full border rounded-md">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
