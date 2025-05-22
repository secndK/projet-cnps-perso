<?php

namespace App\Services;

use App\Models\HistoAttri;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use App\Models\ActionHistoriquePoste;


class LogService
{
    public static function addLog(string $eventType, string $details): void
    {
        // Log::create([
        //     'user' => Auth::user() ? Auth::user()->name : 'System',
        //     'event_type' => $eventType,
        //     'details' => $details,
        // ]);
    }

    public static function attributionLog(
        string $action,
        int $agentId,
        int $attributionId,
        ?array $postes = null,
        ?array $peripheriques = null,
        ?array $postesAjoutes = null,
        ?array $postesRetires = null,
        ?array $peripheriquesAjoutes = null,
        ?array $peripheriquesRetires = null
    ) {
        try {
            DB::table('histo_attri_tables')->insert([
                'action_type' => $action,
                'user_id' => Auth::id(),
                'agent_id' => $agentId,
                'attribution_id' => $attributionId,
                // Enregistre uniquement si pas vide
                'postes' => $action === 'Modification' ? null : (!empty($postes) ? json_encode($postes) : null),
                'peripheriques' => $action === 'Modification' ? null : (!empty($peripheriques) ? json_encode($peripheriques) : null),
                'postes_ajoutes' => !empty($postesAjoutes) ? json_encode($postesAjoutes) : null,
                'postes_retires' => !empty($postesRetires) ? json_encode($postesRetires) : null,
                'peripheriques_ajoutes' => !empty($peripheriquesAjoutes) ? json_encode($peripheriquesAjoutes) : null,
                'peripheriques_retires' => !empty($peripheriquesRetires) ? json_encode($peripheriquesRetires) : null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur journalisation historique: " . $e->getMessage());
        }
    }





}
