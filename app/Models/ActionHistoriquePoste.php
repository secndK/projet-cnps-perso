<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionHistoriquePoste extends Model
{
    protected $fillable = [

       'action_type', 'user_id', 'poste_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }
}
