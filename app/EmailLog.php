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
}
