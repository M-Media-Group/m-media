<?php

namespace App\Policies;

use App\AuthenticationEvent;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthenticationEventPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any authentication_events.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        if (!request()->input('user')) {
            return false;
        }

        return $user->id == request()->input('user');
    }

    /**
     * Determine whether the user can view the authentication_event.
     *
     * @param \App\User  $user
     * @param \App\AuthenticationEvent $authentication_event
     *
     * @return mixed
     */
    public function show(User $user, AuthenticationEvent $authentication_event)
    {

        return false;
    }

    /**
     * Determine whether the user can update the authentication_event.
     *
     * @param \App\User  $user
     * @param \App\AuthenticationEvent $authentication_event
     *
     * @return mixed
     */
    public function update(User $user, AuthenticationEvent $authentication_event)
    {
        return $user->can('manage authentication_events');
    }

    /**
     * Determine whether the user can create authentication_events.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the authentication_event.
     *
     * @param \App\User  $user
     * @param \App\AuthenticationEvent $authentication_event
     *
     * @return mixed
     */
    public function delete(User $user, AuthenticationEvent $authentication_event)
    {
        return $user->can('manage authentication_events');
    }

    /**
     * Determine whether the user can restore the authentication_event.
     *
     * @param \App\User  $user
     * @param \App\AuthenticationEvent $authentication_event
     *
     * @return mixed
     */
    public function restore(User $user, AuthenticationEvent $authentication_event)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the authentication_event.
     *
     * @param \App\User  $user
     * @param \App\AuthenticationEvent $authentication_event
     *
     * @return mixed
     */
    public function forceDelete(User $user, AuthenticationEvent $authentication_event)
    {
        return false;
    }
}
