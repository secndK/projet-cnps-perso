<?php

namespace App\Http\Controllers;

use App\Models\TypePoste;
use App\Models\TypePeripherique;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats pour les postes
        $postesStats = TypePoste::withCount([
            'postes as total',
            'postes as disponibles' => fn($q) => $q->where('statut_poste', 'disponible'),
            'postes as attribues' => fn($q) => $q->where('statut_poste', 'attribué'),
            'postes as reformes' => fn($q) => $q->where('statut_poste', 'réformé'),

           'postes as Bon' => fn($q) => $q->where('etat_poste', 'Bon'),
            'postes as en_service' => fn($q) => $q->where('etat_poste', 'en service'),
            'postes as en_panne' => fn($q) => $q->where('etat_poste', 'en panne'),
            'postes as défectueux' => fn($q) => $q->where('etat_poste', 'défectueux'),

        ])->get();

        // Stats pour les périphériques
        $peripheriquesStats = TypePeripherique::withCount([
            'peripheriques as total',
            'peripheriques as disponibles' => fn($q) => $q->where('statut_peripherique', 'disponible'),
            'peripheriques as attribues' => fn($q) => $q->where('statut_peripherique', 'attribué'),
            'peripheriques as reformes' => fn($q) => $q->where('statut_peripherique', 'réformé'),


            'peripheriques as Bon' => fn($q) => $q->where('etat_peripherique', 'Bon'),
            'peripheriques as en_service' => fn($q) => $q->where('etat_peripherique', 'en service'),
            'peripheriques as en_panne' => fn($q) => $q->where('etat_peripherique', 'en panne'),
            'peripheriques as défectueux' => fn($q) => $q->where('etat_peripherique', 'défectueux'),
        ])->get();

        // dd($postesStats);

        return view('dashboard', compact('postesStats', 'peripheriquesStats'));
    }
}