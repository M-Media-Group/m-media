<?php

namespace App\Policies;

use App\Phone;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhonePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any phones.
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
     * Determine whether the user can view the phone.
     *
     * @param \App\User  $user
     * @param \App\Phone $phone
     *
     * @return mixed
     */
    public function show(User $user, Phone $phone)
    {
        if ($user->phone == $phone->phone) {
            return true;
        }
        if ($phone->user_id) {
            return $user->id == $phone->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the phone.
     *
     * @param \App\User  $user
     * @param \App\Phone $phone
     *
     * @return mixed
     */
    public function update(User $user, Phone $phone)
    {
        if($user->is_locked) {
            return false;
        }
        return $user->can('manage phones');
    }

    /**
     * Determine whether the user can create phones.
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
     * Determine whether the user can delete the phone.
     *
     * @param \App\User  $user
     * @param \App\Phone $phone
     *
     * @return mixed
     */
    public function delete(User $user, Phone $phone)
    {
        if($user->is_locked) {
            return false;
        }
        return $user->can('manage phones');
    }

    /**
     * Determine whether the user can restore the phone.
     *
     * @param \App\User  $user
     * @param \App\Phone $phone
     *
     * @return mixed
     */
    public function restore(User $user, Phone $phone)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the phone.
     *
     * @param \App\User  $user
     * @param \App\Phone $phone
     *
     * @return mixed
     */
    public function forceDelete(User $user, Phone $phone)
    {
        return false;
    }
}
