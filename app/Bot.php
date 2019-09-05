<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'user_id',
        'alias',
        'address',
        'last_ip',
        'last_internal_ip',
        'service_title',
        'georegion',
        'type',
        'is_active',
        'is_servicable',
        'last_contact_at',

    ];

    protected $dates = ['last_contact_at'];

    // protected $appends = ['location'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
