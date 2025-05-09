<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribution extends Model

{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poste_id',
        'peripherique_id',
        'date_attribution',
    ];


    protected $casts = [
        'date_attribution' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postes()
    {
        return $this->belongsToMany(Poste::class);
    }

    public function peripheriques()
    {
        return $this->belongsToMany(Peripherique::class);
    }


}
