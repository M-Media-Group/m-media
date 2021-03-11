<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternshipCertificate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'internship_id', 'file_id', 'uuid', 'personal_message_title', 'personal_message_body', 'congratulations_page_is_public',
    ];

    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'uuid';
	}

 	public function internship()
    {
        return $this->belongsTo('App\Internship');
    }

    public function file()
    {
        return $this->hasOne('App\File', 'id', 'file_id');
    }
}
