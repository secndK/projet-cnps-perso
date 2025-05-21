<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TypePoste;
use App\Services\LogService;
use Illuminate\Support\Facades\Log;
class TypesPostesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = TypePoste::all();
        return view('pages.types-postes.index', compact('types'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.types-postes.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            // Vérifie si le libellé existe déjà
            $existingType = TypePoste::where('libelle_type', $request->libelle_type)->first();

            if ($existingType) {
                return redirect()->back()->withInput()->with('error', 'Ce type de poste existe déjà.');
            }

            // Validation des données
            $validatedData = $request->validate([
                'libelle_type' => 'required|string|max:255|unique:types_postes',
            ]);

            // Création du type
            TypePoste::create($validatedData);

            // Log de l'action
            LogService::addLog('Nouveau Type poste créé','Libellé: ' . $request->libelle_type);

            return redirect()->route('types-postes.index')->with('success', 'Type de Poste ajouté avec succès');

        } catch (\Throwable $e) {
            Log::error("Erreur création TypePoste : " . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la création du type de poste.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $types = TypePoste::findOrFail($id);
        return view('pages.types-postes.show',compact('types'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $types = TypePoste::findOrFail($id);
        return view('pages.types-postes.edit',compact('types'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypePoste $types)
    {
        $validated = $request->validate([
            'libelle_type' => 'required|unique:types_postes,libelle_type,' . $types->id,
        ]);
        $types->update($validated);
        LogService::addLog('MAJ Type poste', ' Libellé : ' . $request->libelle_type);
        return redirect()->route('types-postes.index')->with('success', 'Type de poste mis à jour avec succès');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $types = TypePoste::findOrFail($id);
        $types->delete();
        LogService::addLog('Suppression type postes', 'ID : ' . $id);
        return redirect()->route('types-postes.index')->with('success', 'Type de poste supprimé avec succès');
    }
}
