<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypePeripherique extends Model
{

    use HasFactory;
    protected $table = 'types_peripheriques';
    protected $primaryKey = 'id';
    protected $fillable = [
        'libelle_type',
    ];

    public function peripheriques()
    {
        return $this->hasMany(Peripherique::class);
    }

}
