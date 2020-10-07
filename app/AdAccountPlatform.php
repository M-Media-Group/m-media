<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdAccountPlatform extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'website_id',
        'is_supported',
    ];

    public function website()
    {
        return $this->belongsTo('App\Website');
    }

    public function adAccounts()
    {
        return $this->hasMany('App\AdAccount');
    }

}
