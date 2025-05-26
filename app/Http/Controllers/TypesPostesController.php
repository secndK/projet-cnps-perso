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
   public function index(Request $request)
    {
        try {
            $query = TypePoste::query();

            // Filtre sur libellé du type de poste
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

            return view('pages.types-postes.index', compact('types'));

        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement des types de postes : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les types de postes.');
        }
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
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $types = TypePoste::findOrFail($id);

            $validated = $request->validate([
                'libelle_type' => 'required|unique:types_postes,libelle_type,' . $id,
            ]);

            $types->update($validated);

            LogService::addLog('MAJ Type poste', 'Libellé : ' . $request->libelle_type);

            return redirect()->route('types-postes.index')
                ->with('success', 'Type de poste mis à jour avec succès');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            LogService::addLog('Erreur MAJ Type poste', 'Erreur : ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $types = TypePoste::findOrFail($id);
            $libelle = $types->libelle_type; // Sauvegarde avant suppression

            $types->delete();

            LogService::addLog('Suppression type postes', 'ID : ' . $id . ' - Libellé : ' . $libelle);

            return redirect()->route('types-postes.index')
                ->with('success', 'Type de poste supprimé avec succès');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            LogService::addLog('Erreur suppression type poste', 'Type introuvable - ID : ' . $id);

            return redirect()->route('types-postes.index')
                ->with('error', 'Type de poste introuvable');

        } catch (\Exception $e) {
            LogService::addLog('Erreur suppression type poste', 'Erreur : ' . $e->getMessage() . ' - ID : ' . $id);

            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression');
        }
    }
}