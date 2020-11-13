<?php

namespace App\Listeners;

use App\AuthenticationEvent;
use Auth;
use Illuminate\Auth\Events\Lockout;
use Jenssegers\Agent\Agent;

class LogLockout
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
     * @param Lockout $event
     *
     * @return void
     */
    public function handle(Lockout $event)
    {
        $agent = new Agent();

        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();

        $email = \App\Jobs\SaveEmail::dispatchNow([
            "email" => $event->request->email,
        ]);

        AuthenticationEvent::create([
            'user_id' => null,
            'email_id' => $email->id,
            'event' => 'lockout',
            'guard' => Auth::getDefaultDriver(),
            'device' => $device,
            'device_version' => $agent->version($device),
            'platform' => $platform,
            'platform_version' => $agent->version($platform),
            'browser' => $browser,
            'browser_version' => $agent->version($browser),
            'browser_languages' => $agent->languages(),
            'ip' => $event->request->ip(),
        ]);
    }
}
