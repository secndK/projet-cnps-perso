<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Services\LogService;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Tentative de Connexion');

        $request->validate([
            'matricule_agent' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('matricule_agent', $request->matricule_agent)->first();

        if (!$user) {
            LogService::addLog('Connexion échouée', 'Matricule invalide : ' . $request->matricule_agent);
            return back()->withInput()->with('error', 'Matricule incorrect.');
        }

        if (!Hash::check($request->password, $user->password)) {
            LogService::addLog('Connexion échouée', 'Mot de passe incorrect pour : ' . $request->matricule_agent);
            return back()->withInput()->with('error', 'Mot de passe incorrect.');
        }


        Auth::login($user);
        $request->session()->regenerate();

        LogService::addLog('Connexion', 'Connexion réussie pour ' . $user->matricule_agent);

        return redirect()->route('dashboard')->with('success', 'Connexion réussie.');
    }


    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'matricule_agent' => $data['matricule_agent'],
            'name' => $data['name'],
            'prenom_agent' => $data['prenom_agent'],
            'email' => $data['email'],
            'direction_agent' => $data['direction_agent'],
            'localisation_agent' => $data['localisaon_agent'],
            'password' => Hash::make($data['password']),
        ]);
        event(new Registered($user));
        return $user;
    }
    public function register(Request $request)
    {
        $request->validate([
            'matricule_agent' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'prenom_agent' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'direction_agent' => 'required|string|max:255',
            'localisation_agent' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
         // Attribuer un rôle par défaut


        try {
            $data = $request->only(['matricule_agent','name','prenom_agent','email', 'direction_agent', 'localisation_agent', 'password']);
            $user = $this->create($data);
            Auth::login($user);

            return redirect()->route('verification.notice')
                            ->with('success', 'Account registered successfully! Please verify your email.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        if ($user) {
            LogService::addLog('Tentative de Déconnexion', 'Déconnexion réussie pour ' . $user->name);
        } else {
            LogService::addLog('Déconnexion', 'Déconnexion réussie pour un utilisateur non authentifié');
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
