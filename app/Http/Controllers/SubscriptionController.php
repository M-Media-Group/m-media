<?php

namespace App\Http\Controllers;

use App\User;
use Gate;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        if ($request->input('user')) {
            $user = User::find($user);
        }

        if (Gate::denies('subscriptions.index', $user)) {
            abort(403);
        }

        $subscriptions = \Stripe\Subscription::all(['customer' => $user->stripe_id ?? null, 'expand' => ['data.items.data.plan']]);

        return $subscriptions->data;

    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $subscription = \Stripe\Subscription::retrieve(['id' => $id, 'expand' => ['items.data.plan.product']]);
        if (Gate::denies('subscriptions.view', $subscription)) {
            abort(403);
        }
        return $subscription;
    }
}
