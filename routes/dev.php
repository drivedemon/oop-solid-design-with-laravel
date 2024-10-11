<?php

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Route;

Route::post('test-route-dev', function () {
    $user = User::with(['groupUsers.userGroup'])->where('login_username', 'Drive1')->first();
    $userId = $user->uuid;
    $g = UserGroup::with(['groupUsers.user'])
        ->whereHas('groupUsers', function ($query) use ($userId) {
            $query->where('pcm_user_uuid', $userId);
        })
        ->get();

    return $g;
});
