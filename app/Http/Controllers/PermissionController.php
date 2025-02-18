<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Services\LogService;



class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $permissions = Permission::all();
        // $permissions = Permission::paginate(2);
        return view('pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('pages.permissions.create');
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
        return view('pages.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('pages.permissions.edit', compact('permission'));
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
