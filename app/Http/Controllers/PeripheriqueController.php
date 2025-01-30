<?php

namespace App\Http\Controllers;

use App\Models\Peripherique;
use Illuminate\Http\Request;

class PeripheriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $peripheriques = Peripherique::all();
        return view('peripherique.index', compact('peripheriques'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peripheriques = Peripherique::all();
        return view('peripherique.create', compact('peripheriques'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_serie_peripherique' => 'required|string|max:255',
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'type_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'required|date',

        ]);

        Peripherique::create($validated);

        return redirect()->route('peripherique.index')->with('success', 'Périphérique créé avec succès');
    }
    /**
     * Display the specified resource.
     */

    public function show( $id)
    {
        $peripheriques = Peripherique::findOrFail($id);
        return view('peripherique.show', compact('peripheriques'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le périphérique par son ID
        $peripheriques = Peripherique::findOrFail($id); // Utilisez findOrFail pour éviter les erreurs si l'ID n'existe pas

        // Passer le périphérique à la vue
        return view('peripherique.edit', compact('peripheriques'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peripherique $peripheriques)
    {
        $validated = $request->validate([
            'num_serie_peripherique' => 'required|string|max:255',
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'type_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'required|date',
            
        ]);

        $peripheriques->update($validated);

        return redirect()->route('peripherique.index')->with('success', 'Périphérique mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peripheriques = Peripherique::find($id);
        $peripheriques->delete();
        return redirect()->route('peripherique.index')->with('success', 'Peripherique supprimée avec succès.');


    }
}