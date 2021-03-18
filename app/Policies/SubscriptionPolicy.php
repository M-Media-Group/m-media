<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Stripe\Subscription;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Subscription $subscription
     * @param \App\Subscription $user
     *
     * @return mixed
     */
    public function index(User $user, User $requested_user = null)
    {
        if (! $requested_user) {
            return false;
        }

        return $user->id === $requested_user->id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Subscription $subscription
     * @param \App\Subscription $user
     *
     * @return mixed
     */
    public function view(User $user, Subscription $subscription)
    {
        return $subscription->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Subscription $subscription
     *
     * @return mixed
     */
    public function create($subscription)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Subscription $subscription
     * @param \App\Subscription $user
     *
     * @return mixed
     */
    public function update(User $user, Subscription $subscription)
    {
        if($user->is_locked) {
            return false;
        }
        return $subscription->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Subscription $subscription
     * @param \App\Subscription $user
     *
     * @return mixed
     */
    public function delete(User $user, Subscription $subscription)
    {
        if($user->is_locked) {
            return false;
        }
        return $subscription->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Subscription $subscription
     * @param \App\Subscription $user
     *
     * @return mixed
     */
    public function restore(User $user, Subscription $subscription)
    {
        if($user->is_locked) {
            return false;
        }
        return $subscription->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Subscription $subscription
     * @param \App\Subscription $user
     *
     * @return mixed
     */
    public function forceDelete(User $user, Subscription $subscription)
    {
        return false;
    }
}
