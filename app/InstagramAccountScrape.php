<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramAccountScrape extends Model
{
    protected $fillable = [
        'instagram_account_id',
        'username',
        'full_name',
        'biography',
        'profile_picture_url',
        'external_url',
        'website_id',
        'media_count',
        'followers_count',
        'following_count',
        'avg_likes_count',
        'avg_comments_count',
        'avg_dataset_start',
        'avg_dataset_end',
        'avg_dataset_photos_count',
        'avg_dataset_videos_count',
        'is_private',
        'is_verified',
        'user_id',
    ];

    protected $dates = ['avg_dataset_start', 'avg_dataset_end'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function instagramAccount()
    {
        return $this->belongsTo('App\instagramAccount');
    }

}
