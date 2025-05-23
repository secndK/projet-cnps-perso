<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poste;
use App\Models\Peripherique;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Exemple de regroupement postes par statut (disponible, attribué, réformé)
        $postesStats = \App\Models\Poste::select('statut_poste', DB::raw('count(*) as total'))
            ->groupBy('statut_poste')
            ->pluck('total', 'statut_poste')
            ->toArray();

        $peripheriquesStats = \App\Models\Peripherique::select('statut_peripherique', DB::raw('count(*) as total'))
            ->groupBy('statut_peripherique')
            ->pluck('total', 'statut_peripherique')
            ->toArray();

        // Remplir à 0 les statuts absents pour éviter erreur JS
        $statuts = ['disponible', 'attribué', 'réformé'];

        $postes = [];
        foreach ($statuts as $statut) {
            $postes[$statut] = $postesStats[$statut] ?? 0;
        }

        $peripheriques = [];
        foreach ($statuts as $statut) {
            $peripheriques[$statut] = $peripheriquesStats[$statut] ?? 0;
        }

        // Rôles utilisateurs
        $roles = ['super admin', 'admin', 'user'];
        $rolesCount = [];
        foreach ($roles as $roleName) {
            $role = Role::where('name', $roleName)->first();
            $rolesCount[$roleName] = $role ? $role->users()->count() : 0;
        }

        $data = [
            'postes_total' => array_sum($postes),
            'postes_disponibles' => $postes['disponible'],
            'postes_attribues' => $postes['attribué'],
            'postes_reformes' => $postes['réformé'],

            'peripheriques_total' => array_sum($peripheriques),
            'peripheriques_disponibles' => $peripheriques['disponible'],
            'peripheriques_attribues' => $peripheriques['attribué'],
            'peripheriques_reformes' => $peripheriques['réformé'],

            'utilisateurs_total' => \App\Models\User::count(),
            'roles' => $rolesCount,
        ];

        return view('dashboard', compact('data'));
    }



}
