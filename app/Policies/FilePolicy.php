<?php

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
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
        if (! request()->input('user')) {
            return false;
        }

        return $user->id == request()->input('user');
    }

    /**
     * Determine whether the user can view the file.
     *
     * @param \App\User $user
     * @param \App\File $file
     *
     * @return mixed
     */
    public function show(User $user, File $file)
    {
        if ($file->is_public) {
            return true;
        }
        if ($file->user_id) {
            return $user->id == $file->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param \App\User $user
     * @param \App\File $file
     *
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        if($user->is_locked) {
            return false;
        }
        if ($file->is_locked) {
            return false;
        }
        if ($file->user_id && request()->input('user_id') && $file->user_id !== request()->input('user_id')) {
            return false;
        }
        if ($file->user_id) {
            return $user->id == $file->user_id;
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
        if($user->is_locked) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param \App\User $user
     * @param \App\File $file
     *
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        if($user->is_locked) {
            return false;
        }

        if ($file->is_locked) {
            return false;
        }

        if ($file->user_id) {
            return $user->id == $file->user_id;
        }

        return false;
        //return $user->can('manage files');
    }

    /**
     * Determine whether the user can restore the file.
     *
     * @param \App\User $user
     * @param \App\File $file
     *
     * @return mixed
     */
    public function restore(User $user, File $file)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the file.
     *
     * @param \App\User $user
     * @param \App\File $file
     *
     * @return mixed
     */
    public function forceDelete(User $user, File $file)
    {
        return false;
    }
}
