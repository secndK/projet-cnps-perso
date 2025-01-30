<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PosteTra extends Model
{
    protected $table = 'postetra';

    protected $fillable = [
        'num_serie_postetra',
        'num_inventaire_postetra',
        'nom_postetra',
        'designation_postetra',
        'type_postetra',
        'etat_postetra',
        'date_acq',
    ];



    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

}