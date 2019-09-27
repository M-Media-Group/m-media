<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class File extends Model
{
    //use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'extension',
        'type',
        'mimeType',
        'size',
        'user_id',
        'is_public',
    ];
    // protected $appends = ['location'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getUrlAttribute()
    {
        if (config('filesystems.default') != 's3') {
            return Storage::url($this->getOriginal('url'));
        }
        return $this->is_public ? Storage::url($this->getOriginal('url')) : Storage::temporaryUrl($this->getOriginal('url'), now()->addMinutes(5));
    }

}
