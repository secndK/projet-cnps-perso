<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peripherique;
use App\Models\TypePeripherique;
use App\Services\LogService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeripheriqueController extends Controller
{
    /**
     * Afficher la liste des périphériques.
     */
    public function index()
    {
        $peripheriques = Peripherique::with('typePeripherique')->get();
        return view('pages.peripheriques.index', compact('peripheriques'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $types = TypePeripherique::all();
        return view('pages.peripheriques.create', compact('types'));
    }

    /**
     * Enregistrer un nouveau périphérique.
     */
    public function store(Request $request)
    {
        // Vérification des doublons
        $existingNumSerie = Peripherique::where('num_serie_peripherique', $request->input('num_serie_peripherique'))->first();
        $existingNumInv = Peripherique::where('num_inventaire_peripherique', $request->input('num_inventaire_peripherique'))->first();

        if ($existingNumSerie && $existingNumInv) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le numéro de série ET le numéro d\'inventaire existent déjà.');
        } elseif ($existingNumSerie) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le numéro de série existe déjà.');
        } elseif ($existingNumInv) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le numéro d\'inventaire existe déjà.');
        }

        // Nettoyage des données
        $request->merge([
            'etat_peripherique' => trim($request->input('etat_peripherique')) !== '' ? $request->input('etat_peripherique') : 'N/A',
            'statut_peripherique' => trim($request->input('statut_peripherique')) !== '' ? $request->input('statut_peripherique') : 'N/A',
        ]);

        // Validation
        $validatedData = $request->validate([
            'num_serie_peripherique' => 'required|unique:peripheriques|string|max:255',
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'statut_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'poste_id' => 'nullable|exists:postes,id',
            'type_peripherique_id' => 'required|exists:types_peripheriques,id',
        ]);

        try {
            DB::beginTransaction();

            $peripherique = Peripherique::create($validatedData);
            LogService::posteLog('Création périphérique', $peripherique->id);

            DB::commit();
            return redirect()->route('peripheriques.index')->with('success', 'Périphérique ajouté avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur création périphérique: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création: ' . $e->getMessage());
        }
    }

    /**
     * Afficher les détails.
     */
    public function show($id)
    {
        $peripheriques = Peripherique::with('typePeripherique')->findOrFail($id);
        $types = TypePeripherique::all();
        return view('pages.peripheriques.show', compact('peripheriques', 'types'));
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $peripherique = Peripherique::with('typePeripherique')->findOrFail($id);
        $types = TypePeripherique::all();
        return view('pages.peripheriques.edit', compact('peripherique', 'types'));
    }

    /**
     * Mettre à jour le périphérique.
     */
    public function update(Request $request, $id)
    {
        // Nettoyage des données
        $request->merge([
            'etat_peripherique' => trim($request->input('etat_peripherique')) !== '' ? $request->input('etat_peripherique') : 'N/A',
            'statut_peripherique' => trim($request->input('statut_peripherique')) !== '' ? $request->input('statut_peripherique') : 'N/A',
        ]);

        // Validation
        $validatedData = $request->validate([
            'num_serie_peripherique' => 'required|string|max:255|unique:peripheriques,num_serie_peripherique,'.$id,
            'num_inventaire_peripherique' => 'required|string|max:255',
            'nom_peripherique' => 'required|string|max:255',
            'designation_peripherique' => 'nullable|string|max:255',
            'etat_peripherique' => 'nullable|string|max:255',
            'statut_peripherique' => 'nullable|string|max:255',
            'date_acq' => 'required|date',
            'agent_id' => 'nullable|exists:agents,id',
            'poste_id' => 'nullable|exists:postes,id',
            'type_peripherique_id' => 'required|exists:types_peripheriques,id',
        ]);

        try {
            DB::beginTransaction();

            $peripherique = Peripherique::findOrFail($id);
            $peripherique->update($validatedData);
            LogService::posteLog('Modification périphérique', $peripherique->id);

            DB::commit();
            return redirect()->route('peripheriques.index')->with('success', 'Périphérique mis à jour avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur modification périphérique {$id}: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la modification: ' . $e->getMessage());
        }
    }

    /**
     * Supprimer le périphérique.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $peripherique = Peripherique::findOrFail($id);
            $peripherique->etat_peripherique = 'Réformé';
            $peripherique->statut_peripherique = 'Réformé';
            $peripherique->save();

            LogService::posteLog('Périphérique réformé', $peripherique->id);

            DB::commit();
            return redirect()->route('peripheriques.index')->with('success', 'Périphérique marqué comme réformé');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur réforme périphérique {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la réforme: ' . $e->getMessage());
        }
    }
}
