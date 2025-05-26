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
            'username' => 'required|string',
            'password' => 'required|string',
            'statut_user' => 'nullable|string'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Matricule incorrect.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->with('error', 'Mot de passe incorrect.');
        }


        if ($user->statut_user === 'inactive') {
            return back()->withInput()->with('error', 'Votre compte est désactivé. Veuillez contacter l\'administrateur.');
        }


        Auth::login($user);
        $request->session()->regenerate();

        LogService::addLog('Connexion', 'Connexion réussie pour ' . $user->username);

        return redirect()->route('dashboard')->with('success', 'Connexion réussie.');
    }


    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],

            'name' => $data['name'],

            'email' => $data['email'],

            'password' => Hash::make($data['password']),
        ]);
        event(new Registered($user));
        return $user;
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',

            'name' => 'required|string|max:255|',

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:6|confirmed',
        ]);
         // Attribuer un rôle par défaut


        try {
            $data = $request->only(['username','name','email', 'password']);
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
            LogService::addLog('Tentative de Déconnexion', 'Déconnexion réussie pour ' . $user->username);
        } else {
            LogService::addLog('Déconnexion', 'Déconnexion réussie pour un utilisateur non authentifié');
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
