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
        'etat_peripherique',
        'statut_peripherique',
        'date_acq',
        'user_id',
        'poste_id',
        'type_peripherique_id',
    ];

    public function postes()
    {
        return $this->belongsTo(Poste::class,  'poste_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function typePeripherique()
    {
        return $this->belongsTo(TypePeripherique::class, 'type_peripherique_id');
    }

    public function attributions()
    {
        return $this->hasMany(Attribution::class);
    }

}
