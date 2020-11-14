<?php

namespace App\Http\Controllers;

use App\Jobs\SavePhone;
use App\User;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentActionRequired($payload)
    {
        event(new \App\Events\PaymentActionRequired($payload['data']['object']));

        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerUpdated($payload)
    {
        if ($payload['data']['object']['phone']) {
            $input['phonenumber'] = $payload['data']['object']['phone'];
            $phone = SavePhone::dispatchNow($input);
        } else {
            $phone = (object) [];
            $phone->id = null;
        }

        //Check for default card
        if ($payload['data']['object']['default_source']) {
            $default_card = collect($payload['data']['object']['sources']['data'])->keyBy('id')[$payload['data']['object']['default_source']]['card'];
        } else {
            $default_card = [];
            $default_card['brand'] = null;
            $default_card['last4'] = null;
        }

        $user = User::updateOrCreate(['stripe_id' => $payload['data']['object']['id']], [
            'email' => $payload['data']['object']['email'],
            'phone_id' => $phone->id,
            'card_brand' => $default_card['brand'],
            'card_last_four' => $default_card['last4'],
        ]);
        //$payload['data']['default_source'];
        //return;
        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerDeleted($payload)
    {
        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerCreated($payload)
    {
        $user = User::firstOrCreate(['stripe_id' => $payload['data']['object']['id']], [
            'email' => $payload['data']['object']['email'],
            'password' => 'notset',
        ]);

        $created = $user->wasRecentlyCreated;

        if ($payload['data']['object']['phone']) {
            $input['phonenumber'] = $payload['data']['object']['phone'];
            $phone = SavePhone::dispatchNow($input);
        } else {
            $phone = (object) [];
            $phone->id = null;
        }

        $user->stripe_id = $payload['data']['object']['id'];
        $user->email = $payload['data']['object']['email'];
        $user->phone_id = $phone->id;

        if ($created) {
            // $token = Password::getRepository()->create($user);
            // $user->sendPasswordResetNotification($token);
            event(new \Illuminate\Auth\Events\Registered($user));
            $user->email_verified_at = now();
            $user->save();
        } else {
            $user->save();
        }

        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerDiscountCreated($payload)
    {
        $user = User::where('stripe_id', $payload['data']['object']['customer'])->firstOrFail();

        $user->notify(new \App\Notifications\CustomNotification([
            'send_email' => 1,
            'send_database' => 1,
            'title' => 'Awesome! A discount has been applied to your account.',
            'message' => 'A discount of '
            . ($payload['data']['object']['coupon']['percent_off'] ? $payload['data']['object']['coupon']['percent_off'] . '%' : \Laravel\Cashier\Cashier::formatAmount(($payload['data']['object']['coupon']['amount_off']), $payload['data']['object']['coupon']['currency'])) . ' off '
            . $payload['data']['object']['coupon']['duration']
            . ' has been applied to your account. From now on, you can now enjoy lower prices for ' . config('app.name') . ' products and services.',
        ]));

        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentSucceeded($payload)
    {
        event(new \App\Events\PaymentSucceeded($payload['data']['object']));

        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentFailed($payload)
    {
        event(new \App\Events\PaymentFailed($payload['data']['object']));

        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerSubscriptionUpdated($payload)
    {
        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerSubscriptionDeleted($payload)
    {
        return response('Webhook Handled', 200);
    }
}
