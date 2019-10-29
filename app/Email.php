<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'website_id',
        'user_id',
        'is_public',
        'can_receive_mail',
        'email_verified_at',
        'notes',
    ];

    public function defaultForUser()
    {
        return $this->belongsTo('App\User', 'email', 'email');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function logs()
    {
        return $this->hasMany('App\EmailLog');
    }
}
