<?php

namespace App\serveces;

use App\Models\User;

interface FriendRequestServiceInterface
{
    public function validateRequestIfExistsUserAsReceiver(?string $requestToken, User $user);
    public function validateRequestIfExistsUserAsSender(?string $requestToken, User $user);
    public function createRequestFriend(?string $request, User $user);
}
