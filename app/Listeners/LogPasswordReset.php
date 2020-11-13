<?php

namespace App\Listeners;

use App\AuthenticationEvent;
use App\Notifications\CustomNotification;
use Auth;
use Illuminate\Auth\Events\PasswordReset;
use Jenssegers\Agent\Agent;

class LogPasswordReset
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
     * @param PasswordReset $event
     *
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $agent = new Agent();

        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();

        $event->user->notify(new CustomNotification(
            [
                'send_sms' => 1,
                'send_email' => 1,
                'action' => 'https://blog.mmediagroup.fr/post/how-reset-m-media-password/',
                'action_text' => 'How to reset your password',
                'title' => 'Your '.config('app.name').' password has been reset.',
                'message' => 'Your account password for the email address '.$event->user->email.'  has been changed. If you did not do this, please reset your password immediately and then contact us.',
            ]
        )
        );

        $data = [
            'user_id' => $event->user->id,
            'email_id' => $event->user->primaryEmail->id,
            'event' => 'password_reset',
            'guard' => Auth::getDefaultDriver(),
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
