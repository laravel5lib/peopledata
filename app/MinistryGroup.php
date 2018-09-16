<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MinistryGroup extends Model
{
    protected $table = 'ministry_groups';

    public function members()
    {
        return $this->belongsToMany(Member::class)->withTimestamps();
    }
}
