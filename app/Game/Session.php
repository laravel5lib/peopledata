<?php

namespace App\Game;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'game_sessions';
    protected $guarded = [];
    protected $casts = [
        'questions' => 'array',
    ];
}
