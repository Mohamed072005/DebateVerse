<?php

namespace App\serveces;

use App\Models\User;

interface FriendRequestServiceInterface
{
    public function validateRequestIfExistsUserAsReceiver(?string $requestToken, User $user);
    public function validateRequestIfExistsUserAsSender(?string $requestToken, User $user);
    public function createRequestFriend(?string $request, User $user);
    public function removeFriend(?int $requestToken, User $user);
    public function removeFriendUserAsReceiver(User $user);
    public function removeFriendUserAsSender(User $user);
    public function removeFriendAsSenderOrReceiver(User $user);
}
