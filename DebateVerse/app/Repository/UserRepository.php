<?php

namespace App\Repository;

use App\Models\Friend;
use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function getBySenderIdAndStatus(int $senderId, int $status)
    {
        // TODO: Implement getBySenderIdAndStatus() method.
        $users = Friend::where('sender_id', $senderId)->where('status', $status)->get();
        return $users;
    }

    public function getByReceiverIdAndStatus(int $receiverId, int $status)
    {
        // TODO: Implement getByReceiverIdAndStatus() method.
        $users = Friend::where('receiver_id', $receiverId)->where('status', $status)->get();
        return $users;
    }

    public function getUserById(int $id)
    {
        // TODO: Implement getUserById() method.
        $user = User::where('id', $id)->first([
            'id',
            'user_name',
            'gender_id'
        ]);
        return $user;
    }
}
