<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypePoste;

use App\Models\Poste;

use App\Services\LogService;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        $postes = Poste::with( 'TypePoste')->get();
        return view('pages.postes.index', compact('postes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TypePoste::all();
        return view('pages.postes.create', compact('types'));
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
            'etat_poste' => 'nullable',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'type_poste_id' => 'required|exists:types_postes,id',
        ]);
        Poste::create($validatedData);
        return redirect()->route('postes.index')->with('success', 'Poste créé avec succès.');
    }

/**
 * Affiche les détails d'un poste spécifique.
    */
    public function show($id)
    {

       $postes = Poste::with('TypePoste')->findOrFail($id);
       $types = TypePoste::all();
        return view('pages.postes.show', compact('postes','types'));
    }

    /**
     * Affiche le formulaire d'édition d'un poste.
     */
    public function edit($id)
    {
        $postes = Poste::with( 'TypePoste')->findOrFail($id);
        $types = TypePoste::all();
        return view('pages.postes.edit', compact('postes', 'types'));
    }

    /**
     * Met à jour un poste spécifique dans la base de données.
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'num_serie_poste' => 'required|unique:postes,num_serie_poste,' ,
            'num_inventaire_poste' => 'required|unique:postes,num_inventaire_poste,',
            'nom_poste' => 'required',
            'designation_poste' => 'nullable',
            'type_poste' => 'nullable',
            'etat_poste' => 'nullable',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'type_poste_id' => 'nullable|exists:types_postes,id',
        ]);

        $postes = Poste::findOrFail($id);
        $postes->update($validatedData);
        return redirect()->route('postes.index')->with('success', 'Poste mis à jour avec succès.');
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
