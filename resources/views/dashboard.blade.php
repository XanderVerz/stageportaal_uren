<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Welkom op het dashboard!</h3>
                <p>Op dit dashboard kun je relevante informatie zien over je account of applicatie.</p>
            </div>

            <!-- Voeg hier meer dashboardonderdelen toe indien nodig -->
        </div>
    </div>
</x-layout>
