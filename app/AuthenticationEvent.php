<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthenticationEvent extends Model
{
    protected $fillable = [
        'user_id',
        'email_id',
        'event',
        'guard',
        'device',
        'device_version',
        'platform',
        'platform_version',
        'browser',
        'browser_version',
        'browser_languages',
        'ip',
    ];

    protected $casts = [
        'browser_languages' => 'json',
    ];
}
