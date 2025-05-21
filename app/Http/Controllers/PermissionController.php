<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Services\LogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $permissions = Permission::all();
            return view('pages.permissions.index', compact('permissions'));
        } catch (\Exception $e) {
            Log::error("Erreur lors du chargement des permissions : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger la liste des permissions.');
        }
    }

    public function create()
    {
        try {
            return view('pages.permissions.create');
        } catch (\Exception $e) {
            Log::error("Erreur lors du chargement du formulaire de création : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger le formulaire de création.');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $permission = Permission::create($validated);
            $user = Auth::user();

            LogService::addLog(
                'Création',
                'Création de permission ' . $validated['name'] . ' par ' . $user->matricule_agent,
                $permission->id
            );

            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission créée avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la création de permission : " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création.');
        }
    }

    public function show($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return view('pages.permissions.show', compact('permission'));
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'affichage de la permission {$id} : " . $e->getMessage());
            return redirect()->route('permissions.index')
                ->with('error', 'Permission non trouvée.');
        }
    }

    public function edit($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return view('pages.permissions.edit', compact('permission'));
        } catch (\Exception $e) {
            Log::error("Erreur lors du chargement de l'édition de permission {$id} : " . $e->getMessage());
            return redirect()->route('permissions.index')
                ->with('error', 'Impossible de charger le formulaire d\'édition.');
        }
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id . '|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $oldName = $permission->name;
            $permission->update($validated);
            $user = Auth::user();

            LogService::addLog(
                'Modification',
                'Modification de permission ' . $oldName . ' vers ' . $validated['name'] . ' par ' . $user->matricule_agent,
                $permission->id
            );

            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission mise à jour avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la mise à jour de permission {$permission->id} : " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $permission = Permission::findOrFail($id);
            $permissionName = $permission->name;
            $permission->delete();

            $user = Auth::user();
            LogService::addLog(
                'Suppression',
                'Suppression de permission ' . $permissionName . ' par ' . $user->matricule_agent,
                $id
            );

            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission supprimée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la suppression de permission {$id} : " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
