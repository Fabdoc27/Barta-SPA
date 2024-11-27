<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('users.{user}', function (User $authUser, User $user) {
    return $authUser->id === $user->id;
});