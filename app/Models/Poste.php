<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poste extends Model
{
    protected $table = 'postes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'num_serie_poste',
        'num_inventaire_poste',
        'nom_poste',
        'designation_poste',
        'type_poste',
        'etat_poste',
        'date_acq',
        'agent_id',
    ];


    public function agents()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }


    public function peripheriques()
    {
        return $this->hasMany(Peripherique::class);
    }

}