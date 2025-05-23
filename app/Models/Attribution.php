<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribution extends Model

{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'date_attribution',
        'date_retrait',
    ];


    protected $casts = [
        'date_attribution' => 'date',
        'date_retrait' => 'date',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function postes()
    {
        return $this->belongsToMany(Poste::class);
    }

    public function peripheriques()
    {
        return $this->belongsToMany(Peripherique::class);
    }




}
