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
     * @param \App\User $user
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
     * Determine whether the user can view the bot.
     *
     * @param \App\User $user
     * @param \App\Bot  $bot
     *
     * @return mixed
     */
    public function show(User $user, Bot $bot)
    {
        if ($bot->user) {
            return $user->id === $bot->user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create bots.
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
     * Determine whether the user can update the bot.
     *
     * @param \App\User $user
     * @param \App\Bot  $bot
     *
     * @return mixed
     */
    public function update(User $user, Bot $bot)
    {
        return false;
    }

    /**
     * Determine whether the user can update the bot.
     *
     * @param \App\User $user
     * @param \App\Bot  $bot
     *
     * @return mixed
     */
    public function connectToBot(User $user, Bot $bot)
    {
        if($user->is_locked) {
            return false;
        }
        return $user->can('connect to bots');
    }

    /**
     * Determine whether the user can delete the bot.
     *
     * @param \App\User $user
     * @param \App\Bot  $bot
     *
     * @return mixed
     */
    public function delete(User $user, Bot $bot)
    {
        if($user->is_locked) {
            return false;
        }
        return $user->can('manage bots');
    }

    /**
     * Determine whether the user can restore the bot.
     *
     * @param \App\User $user
     * @param \App\Bot  $bot
     *
     * @return mixed
     */
    public function restore(User $user, Bot $bot)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the bot.
     *
     * @param \App\User $user
     * @param \App\Bot  $bot
     *
     * @return mixed
     */
    public function forceDelete(User $user, Bot $bot)
    {
        return false;
    }
}
