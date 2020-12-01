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
    use HasApiTokens;
    use Notifiable;
    use HasRoles;
    use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'phone_id', 'avatar_file_id', 'seen_at', 'shipping_address_id', 'billing_address_id', 'stripe_id', 'card_brand', 'card_last_four',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['email_verified_at', 'seen_at'];

    public function instagramAccounts()
    {
        return $this->hasMany('App\InstagramAccount');
    }

    //Locked to actual device, not stuff like SSH or VNC devices
    public function bots()
    {
        return $this->hasMany('App\Bot');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function websites()
    {
        return $this->hasMany('App\Website');
    }

    public function avatar()
    {
        return $this->hasOne('App\File', 'id', 'avatar_file_id');
    }

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function primaryPhone()
    {
        return $this->hasOne('App\Phone', 'id', 'phone_id');
    }

    public function emails()
    {
        return $this->hasMany('App\Email');
    }

    public function adAccounts()
    {
        return $this->hasMany('App\AdAccount');
    }

    public function authenticationEvents()
    {
        return $this->hasMany('App\AuthenticationEvent');
    }

    public function recentLogin()
    {
        return $this->hasOne('App\AuthenticationEvent')->latest();
    }

    public function primaryEmail()
    {
        return $this->hasOne('App\Email', 'email', 'email');
    }

    public function shippingAddress()
    {
        return $this->hasOne('App\Address', 'id', 'shipping_address_id');
    }

    public function billingAddress()
    {
        return $this->hasOne('App\Address', 'id', 'shipping_address_id');
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

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * The attribute when the customer last sent a communication message to us.
     *
     * @var array
     */
    public function getLastOutboundContactAtAttribute()
    {
        $last_contact_date_phone = $this->primaryPhone && $this->primaryPhone->latestReceivedLog ? $this->primaryPhone->latestReceivedLog->created_at : null;
        $last_contact_date_email = $this->primaryEmail && $this->primaryEmail->latestReceivedLog ? $this->primaryEmail->latestReceivedLog->created_at : null;

        if ($last_contact_date_phone > $last_contact_date_email) {
            return $last_contact_date_phone;
        }

        return $last_contact_date_email;
    }

    /**
     * The attribute when the customer last received a message from us.
     *
     * @var array
     */
    public function getLastInboundContactAtAttribute()
    {
        $last_contact_date_phone = $this->primaryPhone && $this->primaryPhone->latestLog ? $this->primaryPhone->latestLog->created_at : null;
        $last_contact_date_email = $this->primaryEmail && $this->primaryEmail->latestLog ? $this->primaryEmail->latestLog->created_at : null;

        if ($last_contact_date_phone > $last_contact_date_email) {
            return $last_contact_date_phone;
        }

        return $last_contact_date_email;
    }
}
