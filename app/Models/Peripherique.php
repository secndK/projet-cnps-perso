<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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

    ];


    public function postras(): BelongsToMany
    {
        return $this->belongsToMany(PosteTra::class);
    }

}