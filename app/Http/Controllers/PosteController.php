<?php

namespace App\Http\Controllers;
use App\Models\Poste;
use App\Models\TypePoste;
use App\Models\ActionHistoriquePoste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\LogService;
use App\Http\Controllers\Controller;

class PosteController extends Controller
{
    public function historique()
    {

        try {
             $historiques = ActionHistoriquePoste::with(['user', 'poste'])
            ->orderByDesc('created_at')
            ->get();
            return view('pages.postes.historique', compact('historiques'));


        } catch (\Throwable $e) {
            Log::error("Erreur lors de l'affichage de l'historique du poste : " . $e->getMessage());
            return redirect()->route('postes.index')->with('error', 'Impossible d\'afficher l\'historique.');
        }
    }

    public function index(Request $request)
    {
        try {
            $query = Poste::with(['TypePoste', 'agent'])
                ->orderByRaw("FIELD(statut_poste, 'disponible', 'attribué', 'réformé')");; // pour éviter les requêtes N+1

            // Filtre combiné sur numéro de série ou d'inventaire
            if ($request->filled('numero')) {
                $query->where(function ($q) use ($request) {
                    $q->where('num_serie_poste', 'like', '%' . $request->numero . '%')
                    ->orWhere('num_inventaire_poste', 'like', '%' . $request->numero . '%');
                });
            }

            // Filtre sur état ou statut
            if ($request->filled('etat_statut')) {
                $query->where(function ($q) use ($request) {
                    $q->where('etat_poste', 'like', '%' . $request->etat_statut . '%')
                    ->orWhere('statut_poste', 'like', '%' . $request->etat_statut . '%');
                });
            }

            // Filtre sur la direction via la relation agent
            if ($request->filled('direction')) {
                $query->whereHas('agent', function ($q) use ($request) {
                    $q->where('direction_agent', 'like', '%' . $request->direction . '%');
                });
            }

            $postes = $query->paginate(3)->appends($request->query());
            $types = TypePoste::all();

            return view('pages.postes.index', compact('postes', 'types'));

        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement des postes : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les données pour le formulaire.');
        }
    }


    public function create()
    {
        try {

            $types = TypePoste::all();
            return view('pages.postes.create', compact('types'));

        } catch (\Throwable $e) {

            Log::error("Erreur lors du chargement des types de postes : " . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors du chargement des types de postes.');
        }
    }

    public function store(Request $request, Poste $poste)
    {
        try {
            // Vérifie si le num_inventaire_poste existe et/ou le num_poste sont deja kalé
            $existingNumInv = Poste::where('num_inventaire_poste', $request->input('num_inventaire_poste'))->first();
            $existingNumSerie = Poste::where('num_serie_poste', $request->input('num_serie_poste'))->first();

            if ($existingNumInv && $existingNumSerie) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le numéro d\'inventaire ET le numéro de série existent déjà.');
        } elseif ($existingNumInv) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le numéro d\'inventaire existe déjà.');
        } elseif ($existingNumSerie) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le numéro de série existe déjà.');
        }

            // Remplace les champs vides par "N/A"
            $request->merge([
                'etat_poste' => trim($request->input('etat_poste')) !== '' ? $request->input('etat_poste') : 'N/A',
                'statut_poste' => trim($request->input('statut_poste')) !== '' ? $request->input('statut_poste') : 'N/A',
            ]);

            // Valide les données du formulaire
            $validatedData = $request->validate([
                'num_serie_poste' => 'required|unique:postes',
                'num_inventaire_poste' => 'required|unique:postes',
                'nom_poste' => 'required|string',
                'designation_poste' => 'nullable|string',
                'etat_poste' => 'nullable|string',
                'statut_poste' => 'nullable|string',
                'date_acq' => 'required|date_format:Y-m-d',
                'agent_id' => 'nullable|exists:agents,id',
                'type_poste_id' => 'required|exists:types_postes,id',
            ]);

            Poste::create($validatedData);


            return redirect()->route('postes.index')->with('success', 'Poste créé avec succès.');

        } catch (\Throwable $e) {
            Log::error("Erreur lors de la création d'un poste : " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la création du poste.');
        }
    }

    public function show($id)
    {
        $poste = Poste::with('typePoste', 'agent')->findOrFail($id);
        $types = TypePoste::all();

        return view('pages.postes.show', compact('poste', 'types'));
    }
    /**
     * Affiche le formulaire d'édition d'un poste.
     */
    public function edit($id)
    {
        $poste = Poste::with( 'TypePoste')->findOrFail($id);
        $types = TypePoste::all();
        return view('pages.postes.edit', compact('poste', 'types'));
    }

    /**
     * Met à jour un poste spécifique dans la base de données.
     */
    public function update(Request $request, $id)
    {

        $request->merge([

            'etat_poste' => trim($request->input('etat_poste')) !== '' ? $request->input('etat_poste') : 'N/A',
            'statut_poste' => trim($request->input('statut_poste')) !== '' ? $request->input('statut_poste') : 'N/A',

        ]);

        $validatedData = $request->validate([
            'num_serie_poste' => 'required|unique:postes,num_serie_poste,' . $id,
            'num_inventaire_poste' => 'required|unique:postes,num_inventaire_poste,' . $id,
            'nom_poste' => 'required|string',
            'designation_poste' => 'nullable|string',
            'etat_poste' => 'nullable|string',
            'statut_poste' => 'nullable|string',
            'date_acq' => 'required|date_format:Y-m-d',
            'agent_id' => 'nullable|exists:agents,id',
            'type_poste_id' => 'required|exists:types_postes,id',
        ]);

        $poste = Poste::findOrFail($id);
        $poste->update($validatedData);


        return redirect()->route('postes.index')->with('success', 'Poste mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        try {

            $poste = Poste::findOrFail($id);
            $poste->statut_poste = 'réformé';
            $poste->etat_poste = 'N/A';
            $poste->save();



            return redirect()->route('postes.index')->with('success', 'Le poste a été marqué comme réformé.');
        } catch (\Throwable $e) {
            Log::error("Erreur lors de la tentative de réforme du poste : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de réformer le poste.');
        }
    }



}
