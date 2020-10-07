<?php

namespace App\Policies;

use App\AdAccount;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdAccountPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any AdAccounts.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        if (! request()->input('user')) {
            return false;
        }

        return $user->id == request()->input('user');
    }

    /**
     * Determine whether the user can view the AdAccount.
     *
     * @param \App\User  $user
     * @param \App\AdAccount $AdAccount
     *
     * @return mixed
     */
    public function show(User $user, AdAccount $AdAccount)
    {
        if ($AdAccount->user_id) {
            return $user->id == $AdAccount->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the AdAccount.
     *
     * @param \App\User  $user
     * @param \App\AdAccount $AdAccount
     *
     * @return mixed
     */
    public function update(User $user, AdAccount $AdAccount)
    {
        return $user->can('manage AdAccounts');
    }

    /**
     * Determine whether the user can create AdAccounts.
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
     * Determine whether the user can delete the AdAccount.
     *
     * @param \App\User  $user
     * @param \App\AdAccount $AdAccount
     *
     * @return mixed
     */
    public function delete(User $user, AdAccount $AdAccount)
    {
        return $user->can('manage AdAccounts');
    }

    /**
     * Determine whether the user can restore the AdAccount.
     *
     * @param \App\User  $user
     * @param \App\AdAccount $AdAccount
     *
     * @return mixed
     */
    public function restore(User $user, AdAccount $AdAccount)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the AdAccount.
     *
     * @param \App\User  $user
     * @param \App\AdAccount $AdAccount
     *
     * @return mixed
     */
    public function forceDelete(User $user, AdAccount $AdAccount)
    {
        return false;
    }
}
