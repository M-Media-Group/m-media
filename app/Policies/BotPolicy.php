<?php

namespace App\Policies;

use App\Bot;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BotPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any bots.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the bot.
     *
     * @param  \App\User  $user
     * @param  \App\Bot  $bot
     * @return mixed
     */
    public function show(User $user, Bot $bot)
    {
        return false;
    }

    /**
     * Determine whether the user can create bots.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the bot.
     *
     * @param  \App\User  $user
     * @param  \App\Bot  $bot
     * @return mixed
     */
    public function update(User $user, Bot $bot)
    {
        return false;
    }

    /**
     * Determine whether the user can update the bot.
     *
     * @param  \App\User  $user
     * @param  \App\Bot  $bot
     * @return mixed
     */
    public function connect(User $user, Bot $bot)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the bot.
     *
     * @param  \App\User  $user
     * @param  \App\Bot  $bot
     * @return mixed
     */
    public function delete(User $user, Bot $bot)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the bot.
     *
     * @param  \App\User  $user
     * @param  \App\Bot  $bot
     * @return mixed
     */
    public function restore(User $user, Bot $bot)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the bot.
     *
     * @param  \App\User  $user
     * @param  \App\Bot  $bot
     * @return mixed
     */
    public function forceDelete(User $user, Bot $bot)
    {
        return false;
    }
}
