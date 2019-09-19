<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'username',
        'buffer_id',
        'user_id',
        'is_scrapeable',
        'instagram_id',

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
