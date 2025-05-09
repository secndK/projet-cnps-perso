<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypePoste extends Model
{
    use HasFactory;
    protected $table = 'types_postes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'libelle_type',
    ];

    public function postes()
    {
        return $this->hasMany(Poste::class,);
    }

}
