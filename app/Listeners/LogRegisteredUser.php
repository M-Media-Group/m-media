<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class LogRegisteredUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     *
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->notify(new \App\Notifications\CustomNotification([
            'send_sms' => 1,
            'action' => null,
            'title' => 'Hi! Welcome to the ' . config('app.name') . ' family!',
            'message' => "You're only a step away from completing your account. Just set your account password by following the link we've already sent to your email address, " . $event->user->email . " , and you'll be good to go!",
        ]));
    }
}
