<?php

namespace App\Services;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogService
{
    public static function addLog(string $eventType, string $details = null): void
    {
        Log::create([
            'user' => Auth::user() ? Auth::user()->name : 'System',
            'event_type' => $eventType,
            'details' => $details,
        ]);
    }
}
