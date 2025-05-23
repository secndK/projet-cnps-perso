<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypePeripherique;
use App\Services\LogService;
use Illuminate\Support\Facades\Log;

class TypesPeripheriquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        try {
            $query = TypePeripherique::query();

            // Filtre sur libellé du type de périphérique
            if ($request->filled('libelle')) {
                $query->where('libelle_type', 'like', '%' . $request->libelle . '%');
            }

            // Filtre sur la date de création
            if ($request->filled('created_at')) {
                $query->whereDate('created_at', $request->created_at);
            }

            // Filtre sur la date de mise à jour
            if ($request->filled('updated_at')) {
                $query->whereDate('updated_at', $request->updated_at);
            }

            $types = $query->paginate(2)->appends($request->query());

            return view('pages.types-peripheriques.index', compact('types'));

        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement des types de périphériques : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les types de périphériques.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.types-peripheriques.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Vérifie si le libellé existe déjà
            $existingType = TypePeripherique::where('libelle_type', $request->libelle_type)->first();

            if ($existingType) {
                return redirect()->back()->withInput()->with('error', 'Ce type de périphérique existe déjà.');
            }

            // Validation des données
            $validatedData = $request->validate([
                'libelle_type' => 'required|string|max:255|unique:types_peripheriques,libelle_type',
            ]);

            // Création du type
            TypePeripherique::create($validatedData);

            // Log de l'action
            LogService::addLog('Nouveau Type périphérique créé', 'Libellé: ' . $request->libelle_type);

            return redirect()->route('types-peripheriques.index')->with('success', 'Type de périphérique ajouté avec succès');

        } catch (\Throwable $e) {
            Log::error("Erreur création TypePeripherique : " . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la création du type de périphérique.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $types = TypePeripherique::findOrFail($id);
        return view('pages.types-peripheriques.show', compact('types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $types = TypePeripherique::findOrFail($id);
        return view('pages.types-peripheriques.edit', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypePeripherique $types)
    {
        $validated = $request->validate([
            'libelle_type' => 'required|unique:types_peripheriques,libelle_type,' . $types->id,
        ]);

        $types->update($validated);

        LogService::addLog('MAJ Type périphérique', 'Libellé: ' . $request->libelle_type);

        return redirect()->route('types-peripheriques.index')->with('success', 'Type de périphérique mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $types = TypePeripherique::findOrFail($id);
        $types->delete();

        LogService::addLog('Suppression type périphériques', 'ID: ' . $id);

        return redirect()->route('types-peripheriques.index')->with('success', 'Type de périphérique supprimé avec succès');
    }
}
