<?php

namespace App;

use GuzzleHttp\Client;
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

    public function scrapes()
    {
        return $this->hasMany('App\InstagramAccountScrape');
    }

    public function latestScrape()
    {
        return $this->hasOne('App\InstagramAccountScrape')->latest();
    }

    public function bufferProfile()
    {
        if (! $this->getOriginal('buffer_id')) {
            return false;
        }

        $client = new Client();
        $response = $client->request('GET', 'https://api.bufferapp.com/1/profiles/'.$this->getOriginal('buffer_id').'.json?access_token='.config('blog.buffer.access_token'));
        $data = $response->getBody()->getContents();

        return json_decode($data, true);
    }

    public function bufferSentPosts()
    {
        if (! $this->getOriginal('buffer_id')) {
            return false;
        }

        $client = new Client();
        $response = $client->request('GET', 'https://api.bufferapp.com/1/profiles/'.$this->getOriginal('buffer_id').'/updates/sent.json?access_token='.config('blog.buffer.access_token'));
        $data = $response->getBody()->getContents();

        return json_decode($data, true);
    }
}
