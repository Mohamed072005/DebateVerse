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
        $users = User::where('id', '!=', Auth::id())
            ->where('status', '!=', 0)
            ->get([
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
            ->where('status', '!=', 0)
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

    public function getAdminId()
    {
        // TODO: Implement getAdminIdByRandom() method.
        $admins = User::where('role_id', 2)->get('id');
        return $admins;
    }

    public function getAllUsers()
    {
        // TODO: Implement getAllUsers() method.
        return User::where('id', '!=', Auth::id())->where('role_id', '!=', 1)->get([
            'user_name',
            'email',
            'id',
            'role_id',
            'status'
        ]);
    }

    public function updateUserStatus(int $status, User $user)
    {
        // TODO: Implement updateUserStatus() method.
        $user->status = $status;
        $user->save();
    }

    public function changeUserRole(int $role, User $user)
    {
        // TODO: Implement changeUserRole() method.
        $user->role_id = $role;
        $user->save();
    }

    public function getUsersForStatistics()
    {
        // TODO: Implement getUsersForStatistics() method.
        $users = User::where('role_id', '!=', 2)
            ->where('role_id', '!=', 1)
            ->count();
        return $users;
    }

    public function getAdminsForStatistics()
    {
        // TODO: Implement getAdminsForStatistics() method.
        $admins = User::where('role_id', 2)
            ->count();
        return $admins;
    }
}
