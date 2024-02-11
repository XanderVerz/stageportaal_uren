<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function create()
    {
        // Haal de instelbare waarden op
        $settings = Setting::first();

        return view('worked-hours.create', compact('settings'));
    }

    public function edit(Workhours $workedHour)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($workedHour->gebruiker_id === auth()->user()->id) {
            // Haal de instelbare waarden op
            $settings = Setting::first();

            return view('worked-hours.edit', compact('workedHour', 'settings'));
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('worked-hours.index')->with('error', 'Geen toegang tot deze gegevens.');
        }
    }

    public function store(Request $request)
    {
        // Zorg ervoor dat het gebruikers-ID wordt ingesteld op het ID van de huidige gebruiker
        $request->merge(['gebruiker_id' => auth()->user()->id]);

        // Haal de instelbare waarden op
        $settings = Setting::first();

        // Voer validatie uit
        $validatedData = $request->validate([
            'datum' => 'required|date|unique:workhours,datum,NULL,id,gebruiker_id,' . auth()->id(),
            'start_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i|after:start_tijd',
            'vrije_dag' => 'nullable|boolean',
            'taken' => 'nullable|string',
            'bijzonderheden' => 'nullable|string',
            'gewerkte_uren' => 'required|numeric|min:0',
            'pauze' => 'nullable|numeric|min:0', // Voeg de validatie voor pauze toe
        ]);

       
        // Maak het worked hour object aan
        Workhours::create($validatedData);

        // Redirect naar de juiste pagina
        return redirect()->route('/')->with('success', 'Gewerkte uren toegevoegd.');
    }

    public function update(Request $request, Workhours $workedHour)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($workedHour->gebruiker_id === auth()->user()->id) {
            // Voer validatie uit
            $validatedData = $request->validate([
                'datum' => 'required|date|unique:workhours,datum,' . $workedHour->id . ',id,gebruiker_id,' . auth()->id(),
                'start_tijd' => 'required|date_format:H:i',
                'eind_tijd' => 'required|date_format:H:i|after:start_tijd',
                'vrije_dag' => 'nullable|boolean',
                'taken' => 'nullable|string',
                'bijzonderheden' => 'nullable|string',
                'gewerkte_uren' => 'required|numeric|min:0',
                'pauze' => 'nullable|numeric|min:0',
            ]);
    
            // Update de gewerkte uren
            $workedHour->update($validatedData);
    
            // Redirect naar de juiste pagina
            return redirect()->route('/')->with('success', 'Gewerkte uren bijgewerkt.');
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('/')->with('error', 'Geen toegang tot deze gegevens.');
        }
    }
}