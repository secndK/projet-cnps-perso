<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PosteTravail;
use App\Models\Peripherique;

class PosteTravailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $poste = PosteTravail::with('peripheriques')->get();
        $peripherique = Peripherique::all();
        return view('poste_travail.index', compact('poste', 'peripherique'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('poste_travail.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_serie_poste_travail' => 'required|string|max:255',
            'num_inventaire_poste_travail' => 'required|string|max:255',
            'nom_poste_travail' => 'required|string|max:255',
            'description_poste_travail' => 'nullable|string|max:255',
            'type_poste_travail' => 'required|string|max:255',
            'etat_poste_travail' => 'required|string|max:255',
            'agent_id' => 'nullable|exists:agents,id',
            'date_acq' => 'required|date',
        ]);

        PosteTravail::create($validated);

        return redirect()->route('poste_travail.index')->with('success', 'Poste de travail créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $poste = PosteTravail::with('peripheriques')->findOrFail($id);
        return view('poste_travail.show', compact('poste'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $poste = PosteTravail::findOrFail($id);
        $peripheriquesDisponibles = Peripherique::whereNull('poste_travail_id')->get();
        return view('poste_travail.edit', compact('poste', 'peripheriquesDisponibles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PosteTravail $poste)
    {
        $validated = $request->validate([
            'num_serie_poste_travail' => 'required|string|max:255',
            'num_inventaire_poste_travail' => 'required|string|max:255',
            'nom_poste_travail' => 'required|string|max:255',
            'description_poste_travail' => 'nullable|string|max:255',
            'type_poste_travail' => 'required|string|max:255',
            'etat_poste_travail' => 'required|string|max:255',
            'agent_id' => 'nullable|exists:agents,id',
            'date_acq' => 'required|date',
            'peripheriques' => 'nullable|array',
            'peripheriques.*' => 'exists:peripheriques,id',
        ]);

        // Mettre à jour les informations du poste de travail
        $poste->update($validated);

        // Attribuer les périphériques sélectionnés au poste de travail
        if (isset($validated['peripheriques'])) {
            Peripherique::whereIn('id', $validated['peripheriques'])
                ->update(['poste_travail_id' => $poste->id]);
        }

        return redirect()->route('poste_travail.index')->with('success', 'Poste de travail mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $poste = PosteTravail::findOrFail($id);
        $poste->delete();
        return redirect()->route('poste_travail.index')->with('success', 'Poste de travail supprimé avec succès.');
    }
}