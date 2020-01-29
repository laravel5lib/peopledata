<?php

namespace App\Game;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'game_questions';
    protected $appends = ['options'];

    public function getOptionsAttribute()
    {
        $results = [];
        $results['option_1'] = $this->option_1;
        $results['answer'] = $this->answer;
        $results['option_2'] = $this->option_2;
        $results['option_3'] = $this->option_3;
        uasort($results, function ($a, $b) {
            return rand(-1, 1);
        });
        return $results;
    }
}
