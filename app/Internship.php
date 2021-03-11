<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id', 'notes', 'started_at', 'completed_at', 'contract_file_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'notes',
    ];

    protected $dates = ['started_at', 'completed_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function contract()
    {
        return $this->hasOne('App\File', 'id', 'contract_file_id');
    }

    public function certificate()
    {
        return $this->hasOne('App\InternshipCertificate');
    }
}
