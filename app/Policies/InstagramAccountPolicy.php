<?php

namespace App\Policies;

use App\InstagramAccount;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstagramAccountPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any files.
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
     * Determine whether the user can view the file.
     *
     * @param \App\User $user
     * @param \App\InstagramAccount $instagram_account
     *
     * @return mixed
     */
    public function show(User $user, InstagramAccount $instagram_account)
    {

        if ($instagram_account->user_id) {
            return $user->id == $instagram_account->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param \App\User $user
     * @param \App\InstagramAccount $instagram_account
     *
     * @return mixed
     */
    public function update(User $user, InstagramAccount $instagram_account)
    {
        if ($instagram_account->user_id) {
            return $user->id == $instagram_account->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create files.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param \App\User $user
     * @param \App\InstagramAccount $instagram_account
     *
     * @return mixed
     */
    public function delete(User $user, InstagramAccount $instagram_account)
    {
        if ($instagram_account->user_id) {
            return $user->id == $instagram_account->user_id;
        }

        return false;
        //return $user->can('manage files');
    }

    /**
     * Determine whether the user can restore the file.
     *
     * @param \App\User $user
     * @param \App\InstagramAccount $instagram_account
     *
     * @return mixed
     */
    public function restore(User $user, InstagramAccount $instagram_account)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the file.
     *
     * @param \App\User $user
     * @param \App\InstagramAccount $instagram_account
     *
     * @return mixed
     */
    public function forceDelete(User $user, InstagramAccount $instagram_account)
    {
        return false;
    }
}
