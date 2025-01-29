<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PosteTravail extends Model
{
    use HasFactory;

    protected $table = 'poste_travail';

    protected $fillable = [
        'num_serie_poste_travail',
        'num_inventaire_poste_travail',
        'nom_poste_travail',
        'designation_poste_travail',
        'type_poste_travail',
        'etat_poste_travail',
        'date_acq',
    ];

    public function agent(){

        return $this->belongsTo(Agent::class, 'agent_id');
    }


    public function peripheriques(): HasMany
    {
        return $this->hasMany(Peripherique::class, 'poste_travail_id');
    }
}