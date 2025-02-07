<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peripherique;
use App\Models\Agent;
use App\Models\Poste;
class PeripheriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        $peripheriques = Peripherique::all();
        return view ('peripheriques.index', compact('peripheriques',));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = Agent::all();
        $postes = Poste::all();

        return view('peripheriques.create', compact( 'agents', 'postes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'num_serie_peripherique' => 'required|string|max:255',
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'type_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'poste_id' => 'nullable|exists:postes,id',
        ]);
        
        Peripherique::create($validatedData);

        return redirect()->route('peripheriques.index')->with('success', 'Peripherique ajouté avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $agents = Agent::all();
        $postes = Poste::all();
        $peripheriques = Peripherique::findOrFail($id);
        return view('peripheriques.show', compact('peripheriques', 'agents', 'postes'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agents = Agent::all();
        $postes = Poste::all();
        $peripheriques = Peripherique::findOrFail($id);
        return view('peripheriques.edit', compact('peripheriques', 'agents', 'postes'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'num_serie_peripherique' => 'required|string|max:255',
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'type_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'date',
            'agent_id' => 'nullable|exists:agents,id',
            'poste_id' => 'nullable|exists:postes,id',
        ]);

        $peripherique = Peripherique::findOrFail($id);
        $peripherique->update($validatedData);

        return redirect()->route('peripheriques.index')->with('success', 'Périphérique mis à jour avec succès.');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peripheriques = Peripherique::findOrFail($id);
        $peripheriques->delete();
        return redirect()->route('peripheriques.index')->with('success', 'Périphérique supprimé avec succès.');

    }
}