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

    public static function posteLog(string $action, int $posteId)
    {
            ActionHistoriquePoste::create([
                'action_type' => $action,
                'user_id' => Auth::id(),
                'poste_id' => $posteId,
            ]);
        }

    public static function attributionLog(
        string $action,
        int $agentId,
        int $attributionId,
        ?array $postes = null,
        ?array $peripheriques = null
    ) {
        try {
            DB::table('histo_attri_tables')->insert([
                'action_type' => $action,
                'user_id' => Auth::id(),
                'agent_id' => $agentId,
                'attribution_id' => $attributionId,
                'postes' => !empty($postes) ? json_encode($postes) : null,
                'peripheriques' => !empty($peripheriques) ? json_encode($peripheriques) : null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur journalisation historique: " . $e->getMessage());
        }
    }



    public static function getAttributionLogs($limit = null)
    {
        $query = DB::table('histo_attri_tables')
                ->orderBy('created_at');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }


}
