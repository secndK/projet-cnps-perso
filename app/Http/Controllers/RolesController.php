<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Services\LogService;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $roles = Role::with('permissions')->get(); // Charger les rôles et leurs permissions
        $permissions = Permission::all(); // Charger toutes les permissions
        return view('roles.index', compact('roles', 'permissions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Création du rôle
        $role = Role::create(['name' => $validatedData['name']]);

        // Association des permissions
        if (!empty($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        }

        return redirect()->route('roles.index')->with('success', 'Rôle créé avec succès.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
 * Display the specified resource.
 *
 * @param  Role $role
 * @return \Illuminate\Http\Response
 */
    public function show(Role $role)
    {
        $rolePermissions = $role->permissions; // Récupérer les permissions associées au rôle

        return view('roles.show', compact('role', 'rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // Récupérer toutes les permissions
        $rolePermissions = $role->permissions->pluck('name')->toArray(); // Extraire les noms des permissions associées

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array|nullable', // Permet un tableau de permissions
            'permissions.*' => 'exists:permissions,id', // Validation pour chaque permission
        ]);

        // Mise à jour du rôle
        $role = Role::findOrFail($id);
        $role->update(['name' => $validatedData['name']]);

        // Association des permissions sélectionnées
        if (!empty($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']); // Synchronisation avec les permissions sélectionnées
        } else {
            $role->permissions()->detach(); // Si aucune permission n'est sélectionnée, on retire toutes les permissions
        }

        return redirect()->route('roles.index')->with('success', 'Rôle mis à jour avec succès.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
