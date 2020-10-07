<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdAccount extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ad_account_platform_id',
        'external_account_id',
        'user_id',
        'is_managed',
    ];

    public function platform()
    {
        return $this->belongsTo('App\AdAccountPlatform', 'ad_account_platform_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
