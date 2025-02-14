<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'agents';
    protected $primaryKey = 'id';


    protected $fillable = [

        'matricule_agent',
        'nom_agent',
        'prenom_agent',
        'direction_agent',
        'localisation_agent',
    ];


    public function postes()
    {
        return $this->hasMany(Poste::class, 'poste_id');
    }


    public function peripheriques()
    {
        return $this->hasMany(Peripherique::class, 'peripherique_id');
    }

    public function attributions()
    {
        return $this->hasMany(Attribution::class);
    }

}
