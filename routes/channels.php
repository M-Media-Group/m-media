<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
 */

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('online', function ($user) {
    if (auth()->check()) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});

Broadcast::channel('files.{fileId}', function ($user, $fileId) {
    $file = App\File::findOrFail($fileId);
    if ($user->can('show', $file)) {
        return $user->toArray();
    }
});

Broadcast::channel('users.{userId}', function ($user, $userId) {
    $user = App\User::findOrFail($userId);
    if ($user->can('show', $user)) {
        return $user->toArray();
    }
});
