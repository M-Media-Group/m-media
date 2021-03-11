<?php

namespace App\Policies;

use App\Internship;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternshipPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any Internships.
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
     * Determine whether the user can view the internship.
     *
     * @param \App\User  $user
     * @param \App\Internship $internship
     *
     * @return mixed
     */
    public function show(User $user, Internship $internship)
    {
        return $user->id == $internship->user_id;
    }

    /**
     * Determine whether the user can update the internship.
     *
     * @param \App\User  $user
     * @param \App\Internship $internship
     *
     * @return mixed
     */
    public function update(User $user, Internship $internship)
    {
        return false;
    }

    /**
     * Determine whether the user can create Internships.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function createApplication(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create Internships.
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
     * Determine whether the user can delete the internship.
     *
     * @param \App\User  $user
     * @param \App\Internship $internship
     *
     * @return mixed
     */
    public function delete(User $user, Internship $internship)
    {
        return false;
        //return $user->can('manage Internships');
    }

    /**
     * Determine whether the user can restore the internship.
     *
     * @param \App\User  $user
     * @param \App\Internship $internship
     *
     * @return mixed
     */
    public function restore(User $user, Internship $internship)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the internship.
     *
     * @param \App\User  $user
     * @param \App\Internship $internship
     *
     * @return mixed
     */
    public function forceDelete(User $user, Internship $internship)
    {
        return false;
    }
}
