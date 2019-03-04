<?php

namespace App\PCO;

use App\Member;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
    protected $with = ['professor'];
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
        if(isset($days[$this->day])) return $days[$this->day];
        else return '';
    }

    public function getStyleAttribute()
    {
        if($this->name == 'Vida Nueva') return 'aqua_splash';
        elseif($this->name == 'Ser discípulo implica compromiso devocional') return 'aqua_splash';
        elseif($this->name == 'Mateo 1') return 'star_wine';
        elseif($this->name == 'Tiempos Peligrosos') return 'aqua_splash';
        elseif($this->name == 'Cristo - Espíritu Santo') return 'aqua_splash';
        elseif($this->name == 'Mateo 2') return 'star_wine';
        elseif($this->name == 'Mateo 3') return 'star_wine';
        elseif($this->name == 'Mateo 4') return 'star_wine';
        elseif($this->name == 'Mateo 6') return 'star_wine';
        elseif($this->name == 'Misión Integral') return 'aqua_splash';
        
        return 'winter_neva';
    }

    /**
     * Formats numeric value
     */
    public function formatValue()
    {
        $this->value = '$'.number_format($this->value,'0',',','.');
    }
}
