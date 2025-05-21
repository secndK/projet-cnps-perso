<?php

namespace App\Services;

use App\Models\ActionHistoriquePoste;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class LogService
{
    public static function addLog(string $eventType, string $details): void
    {
        Log::create([
            'user' => Auth::user() ? Auth::user()->name : 'System',
            'event_type' => $eventType,
            'details' => $details,
        ]);
    }

    public static function posteLog(string $action, int $posteId)
    {
        ActionHistoriquePoste::create([
            'action_type' => $action,
            'user_id' => Auth::id(),
            'poste_id' => $posteId,
        ]);
    }





}
