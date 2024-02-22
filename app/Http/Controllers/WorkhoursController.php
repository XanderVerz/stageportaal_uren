<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Workhours;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PDF;
class WorkhoursController extends Controller
{
    public function index()
    {
        // Toon alleen de gewerkte uren van de huidige gebruiker
        $workedHours = Workhours::where('gebruiker_id', auth()->user()->id)->get();
        $totalWorkedHours =$workedHours->sum('gewerkte_uren');
        return view('worked-hours.index', compact('workedHours', 'totalWorkedHours'));
    }

    public function create()
    {
        // Haal de standaardinstellingen voor werktijden op
        $settings = Settings::where('gebruiker_id', auth()->user()->id)->first();

        return view('worked-hours.create', compact('settings'));
    }

    public function store(Request $request)
    {
        // Zorg ervoor dat het gebruikers-ID wordt ingesteld op het ID van de huidige gebruiker
        $request->merge(['gebruiker_id' => auth()->user()->id]);

        // Haal de standaardinstellingen voor werktijden op
        $settings = Settings::where('gebruiker_id', auth()->user()->id)->first();

        try {
        // Voer validatie uit
        $validatedData = $request->validate([
            'datum' => 'required|date|unique:workhours,datum,NULL,id,gebruiker_id,' . auth()->id(),
            'start_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i|after:start_tijd',
            'vrije_dag' => 'nullable|boolean',
            'taken' => 'nullable|string',
            'bijzonderheden' => 'nullable|string',
            'gewerkte_uren' => 'required|numeric|min:0',
            'pauze' => 'nullable|numeric|min:0',
        ]);
     
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->errors())->withInput();
    }
        $validatedData['gebruiker_id'] = auth()->user()->id;
        // Maak het worked hour object aan
        Workhours::create($validatedData);

        // Redirect naar de juiste pagina
        return redirect()->route('dashboard')->with('success', 'Gewerkte uren toegevoegd.');
    }

    public function show(Workhours $workedHour)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($workedHour->gebruiker_id === auth()->user()->id) {
         
            return view('worked-hours.show', compact('workedHour'));
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('worked-hours.index')->with('error', 'Geen toegang tot deze gegevens.');
        }
    }

    public function edit(Workhours $workedHour)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($workedHour->gebruiker_id === auth()->user()->id) {
            return view('worked-hours.edit', compact('workedHour'));
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('dashboard')->with('error', 'Geen toegang tot deze gegevens.');
        }
    }

    public function update(Request $request, Workhours $workedHour)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($workedHour->gebruiker_id === auth()->user()->id) {
            // Haal alle gegevens uit het verzoek
            $data = $request->all();
    
            // Update het Workhours-model met de ontvangen gegevens
            $workedHour->update($data);
    
            // Redirect naar de juiste pagina
            return redirect()->route('dashboard')->with('success', 'Gewerkte uren bijgewerkt.');
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('dashboard')->with('error', 'Geen toegang tot deze gegevens.');
        }
    }

    public function destroy(Workhours $workedHour)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($workedHour->gebruiker_id === auth()->user()->id) {
            // Voer de verwijdering uit
            $workedHour->delete();

            // Redirect naar de juiste pagina
            return redirect()->route('dashboard')->with('success', 'Gewerkte uren verwijderd.');
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('dashboard')->with('error', 'Geen toegang tot deze gegevens.');
        }
    }
    public function generatePdf()
    {
        // Fetch only the data of the authenticated user
        $workedHours = Auth::user()->workedHours;
        $settings = Settings::where('gebruiker_id', auth()->user()->id)->first(); 
    
        // Fetch the name of the authenticated user
        $userName = Auth::user()->name;
        $totalWorkedHours =$workedHours->sum('gewerkte_uren');
        // Controlleer of er instellingen zijn ingesteld
        if (isset($settings)) {
            $pdf = PDF::loadView('pdf.overview', compact('workedHours', 'settings', 'userName', 'totalWorkedHours'));
        
            // Download the PDF
    
             return $pdf->stream('uren_en_taken_overzicht.pdf');
        } else {
            return redirect()->route('dashboard')->with('error', 'Stel eerst de instellingen in.');
        }
    }
}

