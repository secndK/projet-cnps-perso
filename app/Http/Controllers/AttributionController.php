<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attribution;
use App\Models\Poste;
use App\Models\Peripherique;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AttributionController extends Controller
{
    public function index()
    {
        try {
            $attributions = Attribution::with(['user', 'postes', 'peripheriques'])->get();
            return view('pages.attributions.index', compact('attributions'));
        } catch (\Exception $e) {
            Log::error("Erreur lors du chargement des attributions : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les attributions.');
        }
    }


    public function create()
    {
        try {
            return view('pages.attributions.create', [
                'users' => User::all(),
                'postes' => Poste::all(),
                'peripheriques' => Peripherique::all(),
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur lors de la préparation du formulaire de création : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les données pour le formulaire.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
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
                    'postes' => 'Au moins un poste ou un périphérique doit être sélectionné.',
                    'peripheriques' => 'Au moins un poste ou un périphérique doit être sélectionné.'
                ]);
        }

        try {
            DB::beginTransaction();

            // Création de l'attribution
            $attribution = Attribution::create([
                'user_id' => $validatedData['user_id'],
                'date_attribution' => $validatedData['date_attribution'],
                'date_retrait' => $validatedData['date_retrait'] ?? null,
            ]);

            // Gestion des postes
            if (!empty($validatedData['postes'])) {
                $attribution->postes()->sync($validatedData['postes']);

                // Mise à jour des statuts des postes
                Poste::whereIn('id', $validatedData['postes'])
                    ->update([
                        'statut_poste' => 'attribué',
                        'etat_poste' => 'en service'  // Ajout du statut "en service"
                    ]);
            }

            // Gestion des périphériques
            if (!empty($validatedData['peripheriques'])) {
                $attribution->peripheriques()->sync($validatedData['peripheriques']);

                // Mise à jour des statuts des périphériques
                Peripherique::whereIn('id', $validatedData['peripheriques'])
                    ->update([
                        'statut_peripherique' => 'attribué',
                        'etat_peripherique' => 'en service'  // Ajout du statut "en service"
                    ]);
            }

            DB::commit();

            return redirect()->route('attributions.index')
                ->with('success', 'Attribution créée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur création attribution: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur création: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            return view('pages.attributions.edit', [
                'attribution' => Attribution::with(['postes', 'peripheriques'])->findOrFail($id),
                'users' => User::all(),
                'postes' => Poste::all(),
                'peripheriques' => Peripherique::all(),
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur lors du chargement de l'édition de l'attribution : " . $e->getMessage());
            return redirect()->route('attributions.index')->with('error', 'Erreur lors du chargement des données d\'édition.');
        }
    }

   public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
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

            // Récupère les anciennes relations avant modification
            $oldPostes = $attribution->postes->pluck('id')->toArray();
            $oldPeripheriques = $attribution->peripheriques->pluck('id')->toArray();

            // Met à jour les informations de base
            $attribution->update([
                'user_id' => $validatedData['user_id'],
                'date_attribution' => $validatedData['date_attribution'],
                'date_retrait' => $validatedData['date_retrait'] ?? null,
            ]);

            // Synchronise les nouveaux postes
            $newPostes = $validatedData['postes'] ?? [];
            $attribution->postes()->sync($newPostes);

            // Synchronise les nouveaux périphériques
            $newPeripheriques = $validatedData['peripheriques'] ?? [];
            $attribution->peripheriques()->sync($newPeripheriques);

            // Gestion des statuts des postes
            $allPostes = array_unique(array_merge($oldPostes, $newPostes));
            foreach ($allPostes as $posteId) {
                $statut = in_array($posteId, $newPostes) ? 'attribué' : 'non attribué';
                Poste::where('id', $posteId)->update(['statut_poste' => $statut]);
            }

            // Gestion des statuts des périphériques
            $allPeripheriques = array_unique(array_merge($oldPeripheriques, $newPeripheriques));
            foreach ($allPeripheriques as $peripheriqueId) {
                $statut = in_array($peripheriqueId, $newPeripheriques) ? 'attribué' : 'non attribué';
                Peripherique::where('id', $peripheriqueId)->update(['statut_peripherique' => $statut]);
            }

            DB::commit();

            return redirect()->route('attributions.index')->with('success', 'Attribution mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur de mise à jour de l'attribution {$id}: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
       try {
            DB::beginTransaction();

            $attribution = Attribution::findOrFail($id);

            $attribution->update([
                'date_retrait' => now(),
            ]);




            DB::commit();
            return redirect()->route('attributions.index')->with('success', 'Attribution retirée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la mise à jour de la date de retrait : " . $e->getMessage());
            return redirect()->route('attributions.index')->with('error', 'Erreur lors du retrait.');
        }
    }
}
