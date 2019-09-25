<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = [
        'scheme',
        'host',
        'user_id',
        'port',
        'is_scrapeable',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
