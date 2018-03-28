<?php

namespace App\PCO;

use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','sequence','slug'];
}
