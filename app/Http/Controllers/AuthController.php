<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Récupération des identifiants
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // voir ma doc.txt
            $role = $user->getRoleNames();

            // dd($role);

            switch ($role) {
                case 'Super Admin':
                    return redirect()->intended('dashboard')->with('success', 'Connexion réussie en tant qu\'administrateur.');
                case 'Admin':
                    return redirect()->intended('dashboard')->with('success', 'Connexion réussie en tant que manager.');
                default:
                    return redirect()->intended('dashboard')->with('success', 'Connexion réussie.');
            }
        }


        // En cas d'échec de connexion
        return redirect()->route('login')->with('error', 'Identifiants invalides. Veuillez réessayer.');
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    protected function create(array $data)
    {
        $user = User::create([
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
         // Attribuer un rôle par défaut


        try {
            $data = $request->only(['name', 'email', 'password']);
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
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}