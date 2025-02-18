<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribution;
use App\Models\Poste;
use App\Models\Peripherique;
use App\Models\Agent;

class AttributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributions = Attribution::with(['agent', 'postes', 'peripheriques'])->get();
        return view('pages.attributions.index', compact('attributions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.attributions.create', [
            'agents' => Agent::all(),
            'postes' => Poste::all(),
            'peripheriques' => Peripherique::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'agent_id' => 'required|exists:agents,id',
            'postes' => 'required|array|min:1',
            'postes.*' => 'exists:postes,id',
            'peripheriques' => 'required|array|min:1',
            'peripheriques.*' => 'exists:peripheriques,id',


        ]);

        // Création de l'attribution
        $attribution = Attribution::create([
            'libelle_attribution' => $validatedData['libelle_attribution'],
            'agent_id' => $validatedData['agent_id'],
            'date_attribution' => $validatedData['date_attribution'],

        ]);

        // Associer les postes et périphériques
        $attribution->postes()->sync($validatedData['postes']);
        $attribution->peripheriques()->sync($validatedData['peripheriques']);

        return redirect()->route('pages.attributions.index')->with('success', 'Attribution créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attribution = Attribution::with(['agent', 'postes', 'peripheriques'])->findOrFail($id);
        return view('pages.attributions.show', compact('attribution'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.attributions.edit', [
            'attribution' => Attribution::with(['postes', 'peripheriques'])->findOrFail($id),
            'agents' => Agent::all(),
            'postes' => Poste::all(),
            'peripheriques' => Peripherique::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'libelle_attribution' => 'required|string|max:255',
            'agent_id' => 'required|exists:agents,id',
            'postes' => 'required|array|min:1',
            'postes.*' => 'exists:postes,id',
            'peripheriques' => 'required|array|min:1',
            'peripheriques.*' => 'exists:peripheriques,id',
            'date_attribution' => 'required|date',

        ]);

        $attribution = Attribution::findOrFail($id);
        $attribution->update([
            'libelle_attribution' => $validatedData['libelle_attribution'],
            'agent_id' => $validatedData['agent_id'],
            'date_attribution' => $validatedData['date_attribution'],
            'date_retrait' => $validatedData['date_retrait'] ?? null,
        ]);

        // Mettre à jour les relations many-to-many
        $attribution->postes()->sync($validatedData['postes']);
        $attribution->peripheriques()->sync($validatedData['peripheriques']);

        return redirect()->route('pages.attributions.index')->with('success', 'Attribution mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribution = Attribution::findOrFail($id);
        $attribution->postes()->detach();
        $attribution->peripheriques()->detach();
        $attribution->delete();
        return redirect()->route('pages.attributions.index')->with('success', 'Attribution supprimée avec succès.');
    }
}
