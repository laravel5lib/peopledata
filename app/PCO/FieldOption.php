<?php

namespace App\PCO;

use Illuminate\Database\Eloquent\Model;

class FieldOption extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','sequence','value'];

    /**
     * Associated field
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
