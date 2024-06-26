<?php

namespace App\serveces;

use App\Models\Friend;
use App\Models\User;
use App\serveces\FriendRequestServiceInterface;
use Illuminate\Support\Facades\Auth;

class FriendRequestService implements FriendRequestServiceInterface
{

    public function validateRequestIfExistsUserAsReceiver(?string $requestToken, User $user)
    {
        // TODO: Implement validateRequestIfExistsUserAsReceiver() method.
        $receiverFriendRequest = Friend::where('sender_id', $user->id)
            ->where('receiver_id', Auth::user()->id)
            ->first();
        if ($receiverFriendRequest) {
            if ($requestToken == null) {
                return $data = [
                    'status' => false,
                    'route' => 'home',
                    'message' => 'This Friend already send you a friend request, check your Friend Suggestions',
                    'user_id' => null,
                ];
            }
            return $data = [
                'status' => false,
                'route' => 'users.profile',
                'message' => 'This Friend already send you a friend request',
                'user_id' => $user->id,
            ];
        }
        return true;

    }

    public function validateRequestIfExistsUserAsSender(?string $requestToken, User $user)
    {
        // TODO: Implement validateRequestIfExistsUserAsSender() method.

        $receiverFriendRequest = Friend::where('sender_id', Auth::user()->id)
            ->where('receiver_id', $user->id)
            ->first();
        if ($receiverFriendRequest) {

            if ($requestToken == null){
                return $data = [
                    'status' => false,
                    'route' => 'home',
                    'message' => 'You already send a Friend request to this person',
                    'user_id' => null,
                ];
            }
            return $data = [
                'status' => false,
                'route' => 'users.profile',
                'message' => 'You already send a Friend request to this person',
                'user_id' => $user->id,
            ];
        }

        return true;
    }

    public function createRequestFriend(?string $token, User $user)
    {
        // TODO: Implement createRequestFriend() method.
        $return1 = $this->validateRequestIfExistsUserAsReceiver($token, $user);
        if ($return1 !== true) {
            return $return1;
        }
        $return2 = $this->validateRequestIfExistsUserAsSender($token, $user);
        if ($return2 !== true) {
            return $return2;
        }
        Friend::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $user->id
        ]);
        if ($token == null){
            return $data = [
                'status' => true,
                'route' => 'home',
                'message' => 'Your Friend request was sent',
                'user_id' => null,
            ];
        }
        return $data = [
            'status' => true,
            'route' => 'users.profile',
            'message' => 'Your Friend request was sent',
            'user_id' => $user->id
        ];
    }

    public function removeFriendUserAsReceiver(User $user)
    {
        // TODO: Implement removeFriendUserAsReceiver() method.
        $friend = Friend::where('receiver_id', $user->id)->where('sender_id', Auth::id())->first();
        if (!$friend){
            return false;
        }
        $friend->delete();
        return $data = [
            'route' => 'friends',
            'message' => 'Removing Friend Successfully'
        ];
    }

    public function removeFriendUserAsSender(User $user)
    {
        // TODO: Implement removeFriendUserAsSender() method.
        $friend = Friend::where('sender_id', $user->id)->where('receiver_id', Auth::id())->first();
        if (!$friend){
            return false;
        }
        $friend->delete();
        return $data = [
            'route' => 'friends',
            'message' => 'Removing Friend Successfully'
        ];
    }

    public function removeFriendAsSenderOrReceiver(User $user)
    {
        // TODO: Implement removeFriendAsSenderOrReceiver() method.
        $return1 = $this->removeFriendUserAsSender($user);
        if ($return1 !== false) {
            return $data = [
                'route' => 'users.profile',
                'message' => 'Removing Friend Successfully'
            ];
        }
        $return2 = $this->removeFriendUserAsReceiver($user);
        if ($return2 !== false) {
            return $data = [
                'route' => 'users.profile',
                'message' => 'Removing Friend Successfully'
            ];
        }
        return false;
    }

    public function removeFriend(?int $requestToken, User $user)
    {
        // TODO: Implement removeFriend() method.
        if ($requestToken == 1){
//            dd($requestToken);
            $return = $this->removeFriendUserAsReceiver($user);

            if ($return !== false){
                return $return;
            }
        }
        if ($requestToken == 0){
            $return = $this->removeFriendUserAsSender($user);
//            dd($return);
            if ($return !== false){
                return $return;
            }
        }
        if ($requestToken == null){
            $return = $this->removeFriendAsSenderOrReceiver($user);
//            dd($return);
            return $return;
        }
        return false;
    }
}
