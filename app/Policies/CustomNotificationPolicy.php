<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CustomNotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function before($user, $ability)
    {
        return false;
    }
}
