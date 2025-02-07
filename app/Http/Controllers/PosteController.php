<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\P;
use App\Models\Agent;
use App\Models\Poste;
use App\Models\Peripherique;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postes = Poste::with( 'agents')->get();

        
        return view('postes.index', compact('postes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = Agent::all();
        $peripheriques = Peripherique::whereNull('poste_id')->get();
        return view('postes.create', compact('agents', 'peripheriques'));
    }

    /**
     * Store a newly created resource in storage.
     */
   /**
 * Stocke un nouveau poste dans la base de données.
    */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'num_serie_poste' => 'required|unique:postes',
            'num_inventaire_poste' => 'required|unique:postes',
            'nom_poste' => 'required',
            'designation_poste' => 'nullable',
            'type_poste' => 'nullable',
            'etat_poste' => 'nullable',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'peripheriques' => 'nullable|array',
            'peripheriques.*' => 'exists:peripheriques,id',
        ]);
        
        $poste = Poste::create($validatedData);

       
        if (!empty($validatedData['peripheriques'])) {
            $poste->peripheriques()->sync($validatedData['peripheriques']);
        }

  
        return redirect()->route('postes.index')
                        ->with('success', 'Poste créé avec succès.');
    }

/**
 * Affiche les détails d'un poste spécifique.
    */
    public function show($id)
    {
       
        $agents = Agent::all();
        $peripheriques = Peripherique::whereNull('poste_id')->get();

        // Récupération du poste avec ses relations
        $postes = Poste::with(['peripheriques', 'agent'])->findOrFail($id);

        // Retourne la vue avec les données
        return view('postes.show', compact('postes', 'agents', 'peripheriques'));    
    }

    /**
     * Affiche le formulaire d'édition d'un poste.
     */
    public function edit($id)
    {
        
        $postes = Poste::findOrFail($id);
        $peripheriques = Peripherique::where('poste_id', $id)->get();
        $agents = Agent::all();

      
        return view('postes.edit', compact('postes', 'agents', 'peripheriques'));
    }

    /**
     * Met à jour un poste spécifique dans la base de données.
     */
    public function update(Request $request, Poste $postes)
    {

        $validatedData = $request->validate([
            'num_serie_poste' => 'required|unique:postes,num_serie_poste,' . $postes->id,
            'num_inventaire_poste' => 'required|unique:postes,num_inventaire_poste,' . $postes->id,
            'nom_poste' => 'required',
            'designation_poste' => 'nullable',
            'type_poste' => 'nullable',
            'etat_poste' => 'nullable',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'peripheriques' => 'nullable|array',
            'peripheriques.*' => 'exists:peripheriques,id',
        ]);

       
        $postes->update($validatedData);
        
        if (!empty($validatedData['peripheriques'])) {
            $postes->peripheriques()->sync($validatedData['peripheriques']);
        }
       
        return redirect()->route('postes.index')
                        ->with('success', 'Poste mis à jour avec succès.');
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postes = Poste::findOrFail($id);
        $postes->delete();
        return redirect()->route('postes.index')->with('success', 'Postes supprimé avec succès.');
    }
}