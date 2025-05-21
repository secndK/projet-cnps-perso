<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\LogService;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Role::with('permissions')->get();
            $permissions = Permission::all();
            return view('pages.roles.index', compact('roles', 'permissions'));
        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement des rôles : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger la liste des rôles.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $permissions = Permission::get();
            return view('pages.roles.create', compact('permissions'));
        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement du formulaire de création : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger le formulaire de création.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            DB::beginTransaction();

            $role = Role::create(['name' => $validatedData['name']]);

            if (!empty($validatedData['permissions'])) {
                $role->permissions()->sync($validatedData['permissions']);
            }

            $user = Auth::user();
            LogService::addLog(
                'Création',
                'Création du rôle ' . $validatedData['name'] . ' par ' . $user->matricule_agent,
                $role->id
            );

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Rôle créé avec succès.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Erreur lors de la création du rôle : " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création du rôle.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        try {
            $rolePermissions = $role->permissions;
            return view('pages.roles.show', compact('role', 'rolePermissions'));
        } catch (\Throwable $e) {
            Log::error("Erreur lors de l'affichage du rôle {$role->id} : " . $e->getMessage());
            return redirect()->route('roles.index')->with('error', 'Impossible d\'afficher ce rôle.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            $rolePermissions = $role->permissions->pluck('id')->toArray();

            return view('pages.roles.edit', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement de l'édition du rôle {$id} : " . $e->getMessage());
            return redirect()->route('roles.index')->with('error', 'Impossible de charger le formulaire d\'édition.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            DB::beginTransaction();

            $role = Role::findOrFail($id);
            $oldName = $role->name;
            $role->update(['name' => $validatedData['name']]);

            $role->permissions()->sync($validatedData['permissions'] ?? []);

            $user = Auth::user();
            LogService::addLog(
                'Modification',
                'Modification du rôle ' . $oldName . ' vers ' . $validatedData['name'] . ' par ' . $user->matricule_agent,
                $role->id
            );

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Rôle mis à jour avec succès.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Erreur lors de la mise à jour du rôle {$id} : " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();

            $roleName = $role->name;
            $roleId = $role->id;
            $role->delete();

            $user = Auth::user();
            LogService::addLog(
                'Suppression',
                'Suppression du rôle ' . $roleName . ' par ' . $user->matricule_agent,
                $roleId
            );

            DB::commit();
            return redirect()->route('roles.index')
                ->with('success', 'Rôle supprimé avec succès');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Erreur lors de la suppression du rôle {$role->id} : " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
