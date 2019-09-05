<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'phone_id', 'avatar_file_id', 'shipping_address_id', 'billing_address_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['email_verified_at'];

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    #Locked to actual device, not stuff like SSH or VNC devices
    public function bots()
    {
        return $this->hasMany('App\Bot')->where('type', '00:23:00:00:00:01:00:00:04:30:FF:FF:00:01:00:00')->orWhere('service_title', 'Bulk Service');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function avatar()
    {
        return $this->hasOne('App\File', 'id', 'avatar_file_id');
    }

    public function primaryPhone()
    {
        return $this->hasOne('App\Phone', 'id', 'phone_id');
    }

    // public function seenPosts()
    // {
    //     return $this->belongsToMany('App\Post', 'post_views');
    // }

    // public function postViews()
    // {
    //     //Issue with column names in laravel 5.7 see: https://github.com/laravel/framework/issues/17918
    //     return $this->hasManyThrough('App\PostView', 'App\Post', 'user_id', 'post_id', 'id', 'id');
    // }

    // public function postViewsExcludingSelf()
    // {
    //     //Must use whereRaw prob because issue with column in laravel 5.7 names see: https://github.com/laravel/framework/issues/17918
    //     return $this->hasManyThrough('App\PostView', 'App\Post', 'user_id', 'post_id', 'id', 'id')->whereRaw('posts.user_id != post_views.user_id');
    // }

    public function isSuperAdmin()
    {
        return $this->id == config('blog.super_admin_id');
    }

}
