<?php

namespace App\Http\Controllers;
use App\Models\Agent;
use App\Models\Poste;
use App\Models\HistoAttri;
use App\Models\Attribution;
use App\Models\Peripherique;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AttributionController extends Controller
{


    // cette fonction permettra d'afficher l'historique des postes dans la vue nommée 'log'

    public function Logs(Request $request)
    {
        try {


            $from = $request->input('from');
            $to = $request->input('to');
            $action = $request->input('action');
            $search = $request->input('q');

            $query = HistoAttri::orderBy('created_at'  );

            if ($from) {
                $query->where('created_at', '>=', Carbon::parse($from)->startOfDay());
            }

            if ($to) {
                $query->where('created_at', '<=', Carbon::parse($to)->endOfDay());
            }

            if ($action) {
                $query->where('action_type', $action);
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('action_type', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhere('attribution_id', 'like', "%{$search}%")
                    ->orWhereHas('agent', function ($subQ) use ($search) {
                        $subQ->where('nom_agent', 'like', "%{$search}%")
                            ->orWhere('prenom_agent', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%");
                    });
                });
            }

            $logs = $query->paginate(3)->withQueryString();

            // Préchargement des utilisateurs et agents
            $userIds = $logs->pluck('user_id')->unique()->filter()->toArray();
            $agentIds = $logs->pluck('agent_id')->unique()->filter()->toArray();

            $users = \App\Models\User::whereIn('id', $userIds)->get()->keyBy('id');
            $agents = Agent::whereIn('id', $agentIds)->get()->keyBy('id');

            return view('pages.attributions.log', compact('logs', 'users', 'agents', 'from', 'to', 'action', 'search'));

        } catch (\Exception $e) {
            Log::error("Erreur affichage logs: " . $e->getMessage());
            return redirect()->route('attributions.index')
                ->with('error', 'Impossible d\'afficher les logs.');
        }
    }











    public function index(Request $request)
    {
        try {
            $search = $request->input('search');

            $attributions = Attribution::with(['agent', 'postes', 'peripheriques'])
                ->when($search, function ($query, $search) {
                    $query->whereHas('agent', function ($q) use ($search) {
                        $q->where('nom_agent', 'like', "%$search%")
                        ->orWhere('prenom_agent', 'like', "%$search%");
                    });
                })
                ->paginate(4);

            return view('pages.attributions.index', compact('attributions', 'search'));
        } catch (\Exception $e) {
            Log::error("Erreur lors du chargement des attributions : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les attributions.');
        }
    }




    public function create()
    {
        try {
            return view('pages.attributions.create', [

                'agents' => Agent::all(), // Liste de tous les agents
                'postes' => Poste::whereNull('agent_id')->where('etat_poste', '!=', 'réformé')->get(), // Uniquement les postes non attribués
                'peripheriques' => Peripherique::whereNull('agent_id')->where('etat_peripherique', '!=', 'réformé')->get(), // Uniquement les périphériques non attribués

            ]);
        } catch (\Exception $e) {
            Log::error("Erreur lors de la préparation du formulaire de création : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les données pour le formulaire.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'date_attribution' => 'required|date',
            'date_retrait' => 'nullable|date',
            'postes' => 'nullable|array',
            'postes.*' => 'exists:postes,id',
            'peripheriques' => 'nullable|array',
            'peripheriques.*' => 'exists:peripheriques,id',
        ]);

        if (empty($validatedData['postes']) && empty($validatedData['peripheriques'])) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'postes' => 'Au moins un poste ou périphérique doit être sélectionné.',
                    'peripheriques' => 'Au moins un poste ou périphérique doit être sélectionné.'
                ]);
        }

        try {
            DB::beginTransaction();

            $attribution = Attribution::create([
                'agent_id' => $validatedData['agent_id'],
                'date_attribution' => $validatedData['date_attribution'],
                'date_retrait' => $validatedData['date_retrait'] ?? null,
            ]);

            // Gestion des postes
            if (!empty($validatedData['postes'])) {
                $attribution->postes()->sync($validatedData['postes']);

                Poste::whereIn('id', $validatedData['postes'])
                    ->update([
                        'etat_poste' => 'en service',
                        'statut_poste' => 'attribué',
                        'agent_id' => $validatedData['agent_id']
                    ]);
            }

            // Gestion des périphériques
            if (!empty($validatedData['peripheriques'])) {
                $attribution->peripheriques()->sync($validatedData['peripheriques']);

                Peripherique::whereIn('id', $validatedData['peripheriques'])
                    ->update([
                        'etat_peripherique' => 'en service',
                        'statut_peripherique' => 'attribué',
                        'agent_id' => $validatedData['agent_id']
                    ]);
            }

            // Logging
            $postes = $attribution->postes->pluck('id')->toArray();
            $peripheriques = $attribution->peripheriques->pluck('id')->toArray();




            DB::commit();
            LogService::attributionLog('Création', $validatedData['agent_id'], $attribution->id, $postes, $peripheriques);

            return redirect()->route('attributions.index')->with('success', 'Attribution créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur création attribution: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur création: ' . $e->getMessage());
        }
    }


   public function show(string $id)
    {
        try {
            $attribution = Attribution::with(['agent', 'postes', 'peripheriques'])->findOrFail($id);

            // Chargement de tous les agents, postes et périphériques pour l'affichage des infos
            $agents = Agent::all();
            $postes = Poste::all();
            $peripheriques = Peripherique::all();

            return view('pages.attributions.show', compact('attribution', 'agents', 'postes', 'peripheriques'));
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'affichage de l'attribution {$id} : " . $e->getMessage());
            return redirect()->route('attributions.index')->with('error', 'Impossible d\'afficher les détails de l\'attribution.');
        }
    }


    public function edit(string $id)
    {
        try {
            $attribution = Attribution::with(['postes', 'peripheriques'])->findOrFail($id);

            return view('pages.attributions.edit', [
                'attribution' => $attribution,
                'agents' => Agent::all(),
                'postes' => Poste::whereNull('agent_id')
                    ->orWhereIn('id', $attribution->postes->pluck('id'))
                    ->get(),
                'peripheriques' => Peripherique::whereNull('agent_id')
                    ->orWhereIn('id', $attribution->peripheriques->pluck('id'))
                    ->get()
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur édition attribution {$id}: " . $e->getMessage());
            return redirect()->route('attributions.index')->with('error', 'Erreur chargement édition.');
        }
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'date_attribution' => 'required|date',
            'date_retrait' => 'nullable|date',
            'postes' => 'nullable|array',
            'postes.*' => 'exists:postes,id',
            'peripheriques' => 'nullable|array',
            'peripheriques.*' => 'exists:peripheriques,id',
        ]);

        try {
            DB::beginTransaction();

            $attribution = Attribution::findOrFail($id);
            $agentId = $validatedData['agent_id'];

            // Récupération des anciennes relations
            $oldPostes = $attribution->postes->pluck('id')->toArray();
            $oldPeripheriques = $attribution->peripheriques->pluck('id')->toArray();

            // Mise à jour de l'attribution
            $attribution->update([
                'agent_id' => $agentId,
                'date_attribution' => $validatedData['date_attribution'],
                'date_retrait' => $validatedData['date_retrait'] ?? null,
            ]);

            // Gestion des postes
            $newPostes = $validatedData['postes'] ?? [];

            $postesAjoutes = array_diff($newPostes, $oldPostes);
            $postesRetires = array_diff($oldPostes, $newPostes);

            $attribution->postes()->sync($newPostes);

            Poste::whereIn('id', $postesRetires)->update([
                'etat_poste' => 'Bon',
                'statut_poste' => 'disponible',
                'agent_id' => null
            ]);

            Poste::whereIn('id', $newPostes)->update([
                'etat_poste' => 'En service',
                'statut_poste' => 'attribué',
                'agent_id' => $agentId
            ]);

            // Gestion des périphériques
            $newPeripheriques = $validatedData['peripheriques'] ?? [];

            $peripheriquesAjoutes = array_diff($newPeripheriques, $oldPeripheriques);
            $peripheriquesRetires = array_diff($oldPeripheriques, $newPeripheriques);

            $attribution->peripheriques()->sync($newPeripheriques);

            Peripherique::whereIn('id', $peripheriquesRetires)->update([
                'etat_peripherique' => 'Bon',
                'statut_peripherique' => 'diponible',
                'agent_id' => null
            ]);

            Peripherique::whereIn('id', $newPeripheriques)->update([
                'etat_peripherique' => 'en service',
                'statut_peripherique' => 'attribué',
                'agent_id' => $agentId
            ]);

            // Logging détaillé
            LogService::attributionLog(
                'Modification',
                $agentId,
                $attribution->id,
                $newPostes,
                $newPeripheriques,
                $postesAjoutes,
                $postesRetires,
                $peripheriquesAjoutes,
                $peripheriquesRetires
            );

            DB::commit();

            return redirect()->route('attributions.index')
                ->with('success', 'Attribution mise à jour avec succès.')
                ->with('updated_attribution_id', $attribution->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur mise à jour attribution [ID: {$id}]: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }








    //on ne supprime pas vraimment un eattribution vu que on peux réattribué une machine du systmème à quelqun d'autre pour les cas de depart/demission/panne
    //MR KOUAME KOUASSI THIERRY à suggérer de simplement implémenter la date de retrait

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $attribution = Attribution::find($id);
            $postes = $attribution->postes->pluck('id')->toArray();
            $peripheriques = $attribution->peripheriques->pluck('id')->toArray();

            // Mise à jour date retrait
            $attribution->update(['date_retrait' => now()]);

            // Libération des équipements
            Poste::whereIn('id', $postes)->update([
                'etat_poste'=> 'Bon',
                'statut_poste' => 'disponible',
                'agent_id' => null
            ]);

            Peripherique::whereIn('id', $peripheriques)->update([
                'etat_peripherique'=> 'Bon',
                'statut_peripherique' => 'disponible',
                'agent_id' => null
            ]);

            LogService::attributionLog('Retrait', $attribution->agent_id, $attribution->id, $postes, $peripheriques);

            DB::commit();
            return redirect()->route('attributions.index')->with('success', 'Attribution retirée.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur retrait attribution {$id}: " . $e->getMessage());
            return redirect()->route('attributions.index')->with('error', 'Erreur retrait.');
        }
    }
}
