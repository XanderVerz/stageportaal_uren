<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validatie toevoegen indien nodig
            $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);

            // Voeg het gehashte wachtwoord toe aan de data
            $data['password'] = Hash::make($data['password']);
        
            
        
            // Maak de gebruiker aan
            User::create($data);
        
            return redirect()->route('dashboard')
                ->with('success', 'Gebruiker is succesvol toegevoegd.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validatie toevoegen indien nodig
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker is succesvol bijgewerkt.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Gebruiker is succesvol verwijderd.');
    }
    public function toggleAdminStatus(Request $request, User $user)
    {
        // Alleen ingelogde admin kan de admin-status van andere gebruikers wijzigen
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    
        // Schakel tussen 'user' en 'admin'
        $user->role = $user->role === 'user' ? 'admin' : 'user';
        $user->save();
    
        // Redirect terug naar de vorige pagina
        return back();
    }
}

