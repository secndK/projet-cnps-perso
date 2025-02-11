<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('users.index', compact('users','roles'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Attribution du rôle à l'utilisateur
        $user->roles()->attach($request->role_id);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Récupérer les rôles de l'utilisateur
        $userRoles = $user->roles;
        return view('users.show', compact('user', 'userRoles'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Récupérer tous les rôles pour la liste déroulante
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Le mot de passe est optionnel
            'role_id' => 'required|exists:roles,id',
        ]);

        // Mise à jour de l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Mise à jour du rôle de l'utilisateur
        $user->roles()->sync([$request->role_id]);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Supprimer l'utilisateur
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

}
