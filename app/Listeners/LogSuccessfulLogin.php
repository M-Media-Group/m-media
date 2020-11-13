<?php

namespace App\Listeners;

use App\AuthenticationEvent;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Jenssegers\Agent\Agent;

class LogSuccessfulLogin
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
     * @param Login $event
     *
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->seen_at = Carbon::now();
        $event->user->save();

        $agent = new Agent();

        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();

        $data = [
            'user_id' => $event->user->id,
            'email_id' => $event->user->primaryEmail->id,
            'event' => 'login',
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
