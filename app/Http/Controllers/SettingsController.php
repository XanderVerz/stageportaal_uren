<?php 
namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
// SettingsController.php
public function edit()
{
    // Controleer of de huidige gebruiker de eigenaar is
        return view('settings.edit');
}

public function update(Request $request)
{   
// Controleer of de huidige gebruiker de eigenaar is
if (isset(auth()->user()->id)) {
    
    // Haal alle gegevens uit het verzoek
    $data = $request->all();
    
    // Voeg de gebruiker_id toe aan de gegevens
    $data['gebruiker_id'] = auth()->user()->id;

    // Zoek het Settings-model op basis van de gebruiker_id
    $settings = Settings::where('gebruiker_id', auth()->user()->id)->first();

    // Controleer of het instellingsmodel is gevonden
    if ($settings) {
        // Update het Settings-model met de ontvangen gegevens
        $settings->update($data);
        return redirect()->route('dashboard')->with('success', 'Instellingen bijgewerkt.');
    } else {
        // Toon een foutbericht of doorsturen naar de juiste pagina
        return redirect()->route('dashboard')->with('error', 'Instellingen niet gevonden.');
    }
    }

        // Redirect naar de juiste pagina
        return redirect()->route('dashboard')->with('success', 'Instellingen bijgewerkt.');
}
    // Toon alle instellingen
    public function index()
    {
        $settings = Settings::where('gebruiker_id', auth()->user()->id)->get()
        ;
        return view('settings.index', compact('settings'));
    }

    // Laat het formulier zien om instellingen toe te voegen
    public function create()
    {
        return view('settings.create');
    }

    // Opslaan van de instellingen in de database
    public function store(Request $request)
    {
        // Valideer de gegevens
        $validatedData = $request->validate([
            'start_tijd_standaard' => 'required',
            'eind_tijd_standaard' => 'required',
            'pauze_standaard' => 'required',
            'praktijkopleider' => 'required',
            'stagebegeleider' => 'required',
            'leerbedrijf' => 'required',
        ]);
        // Voeg de gebruiker_id toe aan de gevalideerde gegevens
        $validatedData['gebruiker_id'] = auth()->user()->id;
        // Maak het worked hour object aan
        Settings::create($validatedData);
        return redirect()->route('settings.index')->with('success', 'Instellingen zijn toegevoegd.');
    }

    // Laat het verwijderingsformulier zien voor specifieke instellingen
    public function delete(Settings $settings)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($settings->gebruiker_id === auth()->user()->id) {
            return view('settings.delete', compact('settings'));
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('dashboard')->with('error', 'Geen toegang tot deze instellingen.');
        }
    }

    // Verwijder instellingen uit de database
    public function destroy(Settings $settings)
    {
        // Controleer of de huidige gebruiker de eigenaar is
        if ($settings->gebruiker_id === auth()->user()->id) {
            $settings->delete();
            return redirect()->route('settings.index')->with('success', 'Instellingen zijn verwijderd.');
        } else {
            // Toon een foutbericht of doorsturen naar de juiste pagina
            return redirect()->route('dashboard')->with('error', 'Geen toegang tot deze instellingen.');
        }
    }
}
