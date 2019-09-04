<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso',
        'calling_code',
        'is_servicable',
    ];

    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
