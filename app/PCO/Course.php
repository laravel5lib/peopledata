<?php

namespace App\PCO;

use App\Member;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','location', 'day', 'hour','status','period','value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professor()
    {
        return $this->belongsTo(Member::class,'professor_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(Member::class)->withPivot(['status','payment','notes'])->withTimestamps();
    }

    /**
     * @param $hour
     * @return string
     */
    public function getHourAttribute($hour)
    {
        $time = Carbon::parse($hour);
        return $time->format('h:i a');
    }

    /**
     * @param $value
     */
    public function setHourAttribute($value)
    {
        $this->attributes['hour'] = Carbon::parse($value)->toTimeString();
    }

    /**
     * @return mixed
     */
    public function getDayNameAttribute()
    {
        $days = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
        return $days[$this->day];
    }
}
