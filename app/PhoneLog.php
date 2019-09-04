<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_id',
        'type',
        'notes',
        'ended_at',
    ];

    public function phone()
    {
        return $this->belongsTo('App\Phone');
    }
}
