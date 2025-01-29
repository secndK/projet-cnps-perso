<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;



class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $permissions = Permission::all();
        // $permissions = Permission::paginate(2);
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        Permission::create($validated);
        return redirect()->route('permissions.index')->with('success', 'Permissions crée avec  succes');
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($validated);
        return redirect()->route('permissions.index')->with('success', 'Permission mise à jour avec succès');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission supprimée avec succès.');
    }

}