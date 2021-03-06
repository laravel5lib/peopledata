<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    public function members()
    {
        return $this->belongsToMany(Member::class)->withTimestamps();
    }

    public function groups()
    {
        return $this->hasMany(MinistryGroup::class);
    }
}
