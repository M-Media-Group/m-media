<?php

namespace App;

//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
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

    public function getIsPublicAttribute()
    {
        if (file_exists($this->getOriginal('url'))) {
            return Storage::getVisibility($this->getOriginal('url')) === 'private' ? 0 : 1;
        } else {
            return 0;
        }
    }

    public function getTypeAttribute()
    {
        $parts = explode('/', $this->mimeType);

        return $parts[0];
    }

    public function setTypeAttribute()
    {
        $parts = explode('/', $this->attributes['mimeType']);
        $this->attributes['type'] = $parts[0];
    }
}
