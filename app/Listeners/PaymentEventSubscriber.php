<?php

namespace App\Listeners;

use App\Notifications\CustomNotification;
use App\User;

class PaymentEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handlePaymentSucceeded($event)
    {
        $user = User::where('stripe_id', $event->invoice['customer'])->firstOrFail();

        $user->notify(new CustomNotification(
            [

                'send_database' => 1,
                'action' => '/users/' . $user->id . '/billing#invoices',
                'action_text' => 'Go to your invoices',
                'title' => 'Your ' . config('app.name') . ' invoice has been paid.',
                'message' => 'Your invoice for ' . \Laravel\Cashier\Cashier::formatAmount(($event->invoice['amount_paid']), $event->invoice['currency']) . ' has been successfully paid on ' . \Carbon\Carbon::parse($event->invoice['status_transitions']['paid_at'])->format('l jS \o\f F Y \a\t H:i') . '. Thank you for your business.',
            ]
        ));
    }

    /**
     * Handle user logout events.
     */
    public function handlePaymentActionRequired($event)
    {
        $user = User::where('stripe_id', $event->invoice['customer'])->firstOrFail();

        $user->notify(new CustomNotification(
            [
                'send_sms' => 1,
                'send_database' => 1,
                'title' => 'Your need to authorize your recent payment for your ' . config('app.name') . ' invoice.',
                'message' => 'Your payment of ' . \Laravel\Cashier\Cashier::formatAmount(($event->invoice['amount_remaining']), $event->invoice['currency']) . ' on ' . \Carbon\Carbon::parse($event->invoice['status_transitions']['paid_at'])->format('l jS \o\f F Y \a\t H:i') . ' needs to be authorized. Check your email for more instructions.',
            ]
        ));
    }

    /**
     * Handle user logout events.
     */
    public function handlePaymentFailed($event)
    {
        $user = User::where('stripe_id', $event->invoice['customer'])->firstOrFail();

        $user->notify(new CustomNotification(
            [
                'send_sms' => 1,
                'send_database' => 1,
                'title' => 'Your recent payment for your ' . config('app.name') . ' invoice has failed.',
                'message' => 'Your payment of ' . \Laravel\Cashier\Cashier::formatAmount(($event->invoice['amount_paid']), $event->invoice['currency']) . ' has failed on ' . \Carbon\Carbon::parse($event->invoice['status_transitions']['paid_at'])->format('l jS \o\f F Y \a\t H:i') . '. Contact us for more info.',
            ]
        ));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\PaymentSucceeded',
            'App\Listeners\PaymentEventSubscriber@handlePaymentSucceeded'
        );

        $events->listen(
            'App\Events\PaymentActionRequired',
            'App\Listeners\PaymentEventSubscriber@handlePaymentActionRequired'
        );

        $events->listen(
            'App\Events\PaymentFailed',
            'App\Listeners\PaymentEventSubscriber@handlePaymentFailed'
        );
    }
}
