<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peripherique;
use App\Models\Agent;
use App\Models\Poste;
use App\Models\TypePeripherique;
use App\Services\LogService;

class PeripheriqueController extends Controller
{
    /**
     * Afficher la liste des périphériques.
     */
    public function index()
    {
        $peripheriques = Peripherique::with('typePeripherique')->get();
        return view('peripheriques.index', compact('peripheriques'));
    }

    /**
     * Afficher le formulaire de création d'un périphérique.
     */
    public function create()
    {

        $types = TypePeripherique::all();
        return view('peripheriques.create', compact('types'));
    }

    /**
     * Enregistrer un nouveau périphérique.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'num_serie_peripherique' => 'required|string|max:255',
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'poste_id' => 'nullable|exists:postes,id',
            'type_peripherique_id' => 'nullable|exists:types_peripheriques,id',
        ]);

        Peripherique::create($validatedData);

        return redirect()->route('peripheriques.index')->with('success', 'Périphérique ajouté avec succès');
    }
    /**
     * Afficher les détails d'un périphérique.
     */
    public function show($id)
    {
        $peripheriques = Peripherique::with('typePeripherique')->findOrFail($id);
        $types = TypePeripherique::all();

        return view('peripheriques.show', compact('peripheriques','types'));
    }

    /**
     * Afficher le formulaire d'édition d'un périphérique.
     */
    public function edit($id)
    {
        $peripheriques = Peripherique::with('typePeripherique')->findOrFail($id);
        $types = TypePeripherique::all();
        return view('peripheriques.edit', compact('peripheriques','types'));
    }
    /**
     * Mettre à jour un périphérique.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'num_serie_peripherique' => 'required|string|max:255',
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'poste_id' => 'nullable|exists:postes,id',
            'type_peripherique_id' => 'nullable|exists:types_peripheriques,id',
        ]);

        $peripherique = Peripherique::findOrFail($id);
        $peripherique->update($validatedData);

        return redirect()->route('peripheriques.index')->with('success', 'Périphérique mis à jour avec succès');
    }

    /**
     * Supprimer un périphérique.
     */
    public function destroy($id)
    {
        $peripherique = Peripherique::findOrFail($id);
        $peripherique->delete();
        return redirect()->route('peripheriques.index')->with('success', 'Périphérique supprimé avec succès');
    }
}
