<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'gender',
        'type',
        'ranking',
        'player',
        'country',
        'age',
        'points',
        'tournaments'
    ];

    protected $casts = [
        'ranking' => 'integer',
        'age' => 'integer',
        'points' => 'integer',
        'tournaments' => 'integer'
    ];
}
