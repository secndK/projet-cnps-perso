<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Peripherique extends Model
{

    use HasFactory;
    protected $table = 'peripheriques';
    protected $primaryKey = 'id';

    protected $fillable = [
        'num_serie_peripherique',
        'num_inventaire_peripherique',
        'nom_peripherique',
        'designation_peripherique',
        'type_peripherique',
        'etat_peripherique',
        'date_acq',
        'agent_id',
        'poste_id',

    ];


    public function postes()
    {
        return $this->belongsTo(Poste::class,  'poste_id');
    }

    public function agents()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

}