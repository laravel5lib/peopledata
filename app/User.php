<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return bool|mixed|string
     */
    public function getShortName()
    {
        if (str_contains($this->name, " ")) {
            $tokens = explode(" ", $this->name);
            if (count($tokens) >= 4) return $tokens[0] . ' ' . $tokens[1];
            else return $tokens[0];
        } else if (str_contains($this->name, '@')) {
            return substr($this->name, 0, strpos($this->name, "@"));
        } else {
            return $this->name;
        }
    }

    /**
     * Associates a member by email
     */
    public function fixMember()
    {
        if(!$this->member_id){
            if($member = Member::where('email','like',$this->email)->first()){
                $this->member()->associate($member);
                $this->save();
            }
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
