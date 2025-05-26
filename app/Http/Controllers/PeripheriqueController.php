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



    /**
     * Afficher le formulaire de création.
     */


    public function index(Request $request)
    {
        try {
            $query = Peripherique::with(['typePeripherique', 'agent'])
                ->orderByRaw("FIELD(statut_peripherique, 'disponible', 'attribué', 'réformé')");
            // Filtre combiné sur numéro de série ou d'inventaire
            if ($request->filled('numero')) {
                $query->where(function ($q) use ($request) {
                    $q->where('num_serie_peripherique', 'like', '%' . $request->numero . '%')
                    ->orWhere('num_inventaire_peripherique', 'like', '%' . $request->numero . '%');
                });
            }

            // Filtre combiné sur état ou statut
            if ($request->filled('etat_statut')) {
                $query->where(function ($q) use ($request) {
                    $q->where('etat_peripherique', 'like', '%' . $request->etat_statut . '%')
                    ->orWhere('statut_peripherique', 'like', '%' . $request->etat_statut . '%');
                });
            }

            // Filtre sur la direction via la relation agent
            if ($request->filled('direction')) {
                $query->whereHas('agent', function ($q) use ($request) {
                    $q->where('direction_agent', 'like', '%' . $request->direction . '%');
                });
            }

            // Pagination avec conservation des filtres
            $peripheriques = $query->paginate(3)->appends($request->query());

            // Récupération des types de périphériques pour le filtre
            $types = TypePeripherique::all();

            return view('pages.peripheriques.index', compact('peripheriques', 'types'));

        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement des périphériques : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les périphériques.');
        }
    }

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

            Peripherique::create($validatedData);

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
        $peripheriques = Peripherique::with('typePeripherique', 'agent')->findOrFail($id);
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
            $peripherique->statut_peripherique = 'réformé';
            $peripherique->etat_peripherique = 'N/A';
            $peripherique->save();


            DB::commit();
            return redirect()->route('peripheriques.index')->with('success', 'Périphérique marqué comme réformé');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur réforme périphérique {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la réforme: ' . $e->getMessage());
        }
    }
}
