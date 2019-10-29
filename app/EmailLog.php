<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'type',
        'from_display',
        'email_id',
        'reply_to_email_id',
        'to_email_id',
        'aws_message_id',
        'status',
        'subject',
        'notes',
    ];

    public function email()
    {
        return $this->belongsTo('App\Email');
    }

    public function to_email()
    {
        return $this->belongsTo('App\Email', 'to_email_id', 'id');
    }

    public function reply_to_email()
    {
        return $this->belongsTo('App\Email', 'reply_to_email_id', 'id');
    }
}
