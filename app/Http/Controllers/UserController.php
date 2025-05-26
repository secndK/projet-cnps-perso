<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $role = $request->input('role');

            $users = User::with('roles')
                ->when($search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                    });
                })
                ->when($role, function ($query, $role) {
                    $query->whereHas('roles', function ($q) use ($role) {
                        $q->where('name', $role);
                    });
                })
                ->paginate(4);

            $roles = Role::all(); // pour remplir le select des rôles
            return view('pages.users.index', compact('users', 'roles'));
        } catch (\Throwable $e) {
            Log::error("Erreur lors du chargement des utilisateurs : " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger la liste des utilisateurs.');
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
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username' .$id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'statut_user' => 'nullable|string|max:8',

        ]);
        // dd($request->all());

        try {
            DB::beginTransaction();
            $user = User::create([

                'username' => $validatedData['username'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'statut_user' => $validatedData['statut_user'],
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


        // Empêcher un utilisateur de se rendre lui-même inactif

        $user = User::findOrFail($id);

        if (Auth::id() === $user->id && $request->statut_user === 'inactif') {
            return back()->with('error', 'Vous ne pouvez pas désactiver votre propre compte.');
        }
        $attiéké = [

            'username' => 'required|string|max:255|unique:users,username' .$id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'statut_user' => 'nullable|string|max:8',


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
                'username'            => $validatedData['username'],
                'name'                => $validatedData['name'],
                'email'               => $validatedData['email'],
                'statut_user' => $validatedData['statut_user'],


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
