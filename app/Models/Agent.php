<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{

    use HasFactory;

    protected $fillable = [
        'matricule_agent',
        'nom_agent',
        'prenom_agent',
        'direction_agent',
        'localisation_agent',

    ];


     public function postes()
    {
        return $this->hasMany(Poste::class);
    }

    public function peripheriques()
    {
        return $this->hasMany(Peripherique::class);
    }

}
