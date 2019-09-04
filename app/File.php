<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
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

}
