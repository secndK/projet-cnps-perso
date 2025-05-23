<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoAttri extends Model
{

    protected $table = 'histo_attri_tables';

    protected $fillable = [

        'action_type',
        'attribution_id',
        'user_id',
        'agent_id',
        'postes',
        'peripheriques',
        'postes_ajoutes',
        'postes_retires',
        'peripheriques_ajoutes',
        'peripheriques_retires',

    ];

     protected $casts = [
        'postes' => 'array',
        'peripheriques' => 'array',
        'postes_ajoutes' => 'array',
        'postes_retires' => 'array',
        'peripheriques_ajoutes' => 'array',
        'peripheriques_retires' => 'array',
    ];




    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function agent()
    {
        return $this->belongsTo(\App\Models\Agent::class);
    }

    public function attribution()
    {
        return $this->belongsTo(Attribution::class);
    }



}
