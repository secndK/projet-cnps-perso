<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        try {
            $users = User::with('roles')->get(); // Charge les utilisateurs ET leurs rôles
            $roles = Role::all();
            return view('pages.users.index', compact('users','roles'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement des rôles : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger les rôles.');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('pages.users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'matricule_agent' => 'required|string|max:255|unique:users,matricule_agent',
            'name' => 'required|string|max:255',
            'prenom_agent' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'direction_agent' => 'required|string|max:255',
            'localisation_agent' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'matricule_agent' => $validatedData['matricule_agent'],
                'name' => $validatedData['name'],
                'prenom_agent' => $validatedData['prenom_agent'],
                'email' => $validatedData['email'],
                'direction_agent' => $validatedData['direction_agent'],
                'localisation_agent' => $validatedData['localisation_agent'],
                'password' => Hash::make($validatedData['password']),
            ]);


            $user->roles()->attach($validatedData['role_id']);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création de l\'utilisateur.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Récupérer les rôles de l'utilisateur
        $userRoles = $user->roles;
        return view('pages.users.show', compact('user', 'userRoles'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = Role::all();

            return view('pages.users.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            Log::error("Erreur lors du chargement de l'édition de l'utilisateur : " . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Utilisateur introuvable ou erreur lors du chargement.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $attiéké = [
            'matricule_agent' => 'required|string|max:255|unique:users,matricule_agent,' . $id,
            'name' => 'required|string|max:255',
            'prenom_agent' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'direction_agent' => 'required|string|max:255',
            'localisation_agent' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ];

        // Ajoute la validation du mot de passe si présent
        if ($request->filled('password')) {
            $attiéké['password'] = 'required|string|confirmed|min:8';
        }

        $validatedData = $request->validate($attiéké);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->update([
                'matricule_agent'     => $validatedData['matricule_agent'],
                'name'                => $validatedData['name'],
                'prenom_agent'        => $validatedData['prenom_agent'],
                'email'               => $validatedData['email'],
                'direction_agent'     => $validatedData['direction_agent'],
                'localisation_agent'  => $validatedData['localisation_agent'],
            ]);

            // Met à jour le mot de passe uniquement si fourni
            if (!empty($validatedData['password'])) {
                $user->update([
                    'password' => bcrypt($validatedData['password']),
                ]);
            }


            $user->roles()->sync([$validatedData['role_id']]);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour de l\'utilisateur.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->roles()->detach();
            $user->delete();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Erreur lors de la suppression de l\'utilisateur.');
        }
    }

}
