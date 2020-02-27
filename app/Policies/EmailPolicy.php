<?php

namespace App\Policies;

use App\Email;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any emails.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the email.
     *
     * @param \App\User  $user
     * @param \App\Email $email
     *
     * @return mixed
     */
    public function show(User $user, Email $email)
    {
        if ($user->email == $email->email) {
            return true;
        }
        if ($email->user_id) {
            return $user->id == $email->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the email.
     *
     * @param \App\User  $user
     * @param \App\Email $email
     *
     * @return mixed
     */
    public function update(User $user, Email $email)
    {
        if ($user->email == $email->email) {
            return true;
        }
        if ($email->user_id) {
            return $user->id == $email->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create emails.
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
     * Determine whether the user can delete the email.
     *
     * @param \App\User  $user
     * @param \App\Email $email
     *
     * @return mixed
     */
    public function delete(User $user, Email $email)
    {
        if ($email->user_id) {
            return $user->id == $email->user_id;
        }

        return false;
        //return $user->can('manage emails');
    }

    /**
     * Determine whether the user can restore the email.
     *
     * @param \App\User  $user
     * @param \App\Email $email
     *
     * @return mixed
     */
    public function restore(User $user, Email $email)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the email.
     *
     * @param \App\User  $user
     * @param \App\Email $email
     *
     * @return mixed
     */
    public function forceDelete(User $user, Email $email)
    {
        return false;
    }
}
