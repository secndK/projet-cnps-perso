<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attribution;
use App\Models\Poste;
use App\Models\Peripherique;
use App\Models\User;
class AttributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributions = Attribution::with(['user', 'postes', 'peripheriques'])->get();
        return view('pages.attributions.index', compact('attributions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.attributions.create', [
            'users' => User::all(),
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
            'user_id' => 'required|exists:users,id',
            'date_attribution' => 'required|date|date_format:Y-m-d',
            'postes' => 'required|array|min:1',
            'postes.*' => 'exists:postes,id',
            'peripheriques' => 'required|array|min:1',
            'peripheriques.*' => 'exists:peripheriques,id',
        ]);
        $attribution = Attribution::create([
            'user_id' => $validatedData['user_id'],
            'date_attribution' => $validatedData['date_attribution'],
        ]);
        // Associer les postes et périphériques
        $attribution->postes()->sync($validatedData['postes']);
        $attribution->peripheriques()->sync($validatedData['peripheriques']);
        return redirect()->route('attributions.index')->with('success', 'Attribution créée avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attribution = Attribution::with(['user', 'postes', 'peripheriques'])->findOrFail($id);
        $users = User::all();
        $postes = Poste::all();
        $peripheriques = Peripherique::all();
        return view('pages.attributions.show', compact('attribution','users', 'postes', 'peripheriques'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.attributions.edit', [
            'attribution' => Attribution::with(['postes', 'peripheriques'])->findOrFail($id),
            'users' => User::all(),
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
            // 'libelle_attribution' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'postes' => 'required|array|min:1',
           'date_attribution' => 'required|date|date_format:Y-m-d',
            'postes.*' => 'exists:postes,id',
            'peripheriques' => 'required|array|min:1',
            'peripheriques.*' => 'exists:peripheriques,id',
            // 'date_attribution' => 'required|date',

        ]);
        $attribution = Attribution::findOrFail($id);
        $attribution->update([
            // 'libelle_attribution' => $validatedData['libelle_attribution'],
            'user_id' => $validatedData['user_id'],
            // 'date_attribution' => $validatedData['date_attribution'],
            // 'date_retrait' => $validatedData['date_retrait'] ?? null,
        ]);

        // Mettre à jour les relations many-to-many
        $attribution->postes()->sync($validatedData['postes']);
        $attribution->peripheriques()->sync($validatedData['peripheriques']);
        return redirect()->route('attributions.index')->with('success', 'Attribution mise à jour avec succès.');
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
        return redirect()->route('attributions.index')->with('success', 'Attribution supprimée avec succès.');
    }
}
