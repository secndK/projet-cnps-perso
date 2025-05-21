<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Poste extends Model
{

    use HasFactory;
    protected $table = 'postes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'num_serie_poste',
        'num_inventaire_poste',
        'nom_poste',
        'designation_poste',
        'etat_poste',
        'statut_poste',
        'date_acq',
        'user_id',
        'type_poste_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function peripheriques()
    {
        return $this->hasMany(Peripherique::class);
    }

    public function typePoste()
    {
        return $this->belongsTo(TypePoste::class);
    }

    public function attributions()
    {
        return $this->belongsToMany(Attribution::class);
    }

}
