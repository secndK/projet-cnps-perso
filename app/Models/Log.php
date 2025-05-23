<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $primaryKey = 'id';

    protected $fillable = [

        'user',
        'event_type',
        'details',

    ];
}
