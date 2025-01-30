<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'agents';


    protected $fillable = [

        'matricule_agent',
        'nom_agent',
        'prenom_agent',
        'direction_agent',
        'localisation_agent',
    ];


    public function postetras(): HasMany
    {
        return $this->hasMany(PosteTra::class);
    }



    public function peripheriques(): HasMany
    {
        return $this->hasMany(Peripherique::class);
    }



}