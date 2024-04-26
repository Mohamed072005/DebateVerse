<?php

namespace App\Repository;

use App\Models\Friend;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function getUsersWithoutAuthenticatedUser()
    {
        // TODO: Implement getUsersWithoutAuthenticatedUser() method.
        $users = User::where('id', '!=', Auth::id())->get([
            'user_name',
            'id',
            'gender_id'
        ]);
        return $users;
    }

    public function findUserByUserName(string $user_name)
    {
        // TODO: Implement findUserByUserName() method.
        $result = User::where('user_name', 'LIKE', '%'.$user_name.'%')
            ->where('id', '!=', Auth::id())
            ->get([
            'user_name',
            'id',
            'gender_id'
        ]);
        return $result;
    }

    public function register(array $user, string $userName)
    {
        // TODO: Implement register() method.
        User::create([
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'user_name' => $userName,
            'password' => Hash::make($user['password']),
            'phone_number' => $user['phoneNumber'],
            'role_id' => 3,
            'gender_id' => $user['gender_name']
        ]);
    }
}
