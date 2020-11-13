<?php

namespace App\Listeners;

use App\AuthenticationEvent;
use Illuminate\Auth\Events\Failed;
use Jenssegers\Agent\Agent;

class LogFailedLogin
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
     * @param Failed $event
     *
     * @return void
     */
    public function handle(Failed $event)
    {
        $agent = new Agent();

        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();

        $email = \App\Jobs\SaveEmail::dispatchNow([
            "email" => $event->credentials["email"],
        ]);

        $data = [
            'user_id' => optional($event->user)->id,
            'email_id' => $email->id,
            'event' => 'failed_login',
            'guard' => $event->guard,
            'device' => $device,
            'device_version' => $agent->version($device),
            'platform' => $platform,
            'platform_version' => $agent->version($platform),
            'browser' => $browser,
            'browser_version' => $agent->version($browser),
            'browser_languages' => $agent->languages(),
            'ip' => app('request')->ip(),
        ];

        AuthenticationEvent::create($data);
    }
}
