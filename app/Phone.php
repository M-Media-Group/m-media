<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'e164',
        'number',
        'country_id',
        'number_type',
        'timezone',
        'description',
        'user_id',
        'verification_code',
        'phone_verified_at',
        'is_public',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'verification_code',
    ];

    // protected $appends = ['location'];

    public function defaultForUser()
    {
        return $this->belongsTo('App\User', 'id', 'phone_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function logs()
    {
        return $this->hasMany('App\PhoneLog');
    }

}