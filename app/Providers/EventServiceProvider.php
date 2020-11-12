<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            //'App\Listeners\LogRegisteredUser',
            SendEmailVerificationNotification::class,
        ],

        #Apparently the following events/listeners are already loaded somewhere and don't need to be done here

        // 'Illuminate\Auth\Events\Attempting' => [
        //     'App\Listeners\LogAuthenticationAttempt',
        // ],

        // 'Illuminate\Auth\Events\Authenticated' => [
        //     'App\Listeners\LogAuthenticated',
        // ],

        // 'Illuminate\Auth\Events\Login' => [
        //     'App\Listeners\LogSuccessfulLogin',
        // ],

        // 'Illuminate\Auth\Events\Failed' => [
        //     'App\Listeners\LogFailedLogin',
        // ],

        // 'Illuminate\Auth\Events\Logout' => [
        //     'App\Listeners\LogSuccessfulLogout',
        // ],

        // 'Illuminate\Auth\Events\Lockout' => [
        //     'App\Listeners\LogLockout',
        // ],

        // 'Illuminate\Auth\Events\PasswordReset' => [
        //     'App\Listeners\LogPasswordReset',
        // ],

    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\PaymentEventSubscriber',
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
