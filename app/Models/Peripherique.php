<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Peripherique extends Model
{

    use HasFactory;
    protected $table = 'peripherique';

    protected $fillable = [
        'num_serie_peripherique',
        'num_inventaire_peripherique',
        'nom_peripherique',
        'designation_peripherique',
        'type_peripherique',
        'etat_peripherique',
        'date_acq',
        'poste_travail_id',
    ];



    public function posteTravail(): BelongsTo
    {
        return $this->belongsTo(PosteTravail::class, 'poste_travail_id');
    }


}