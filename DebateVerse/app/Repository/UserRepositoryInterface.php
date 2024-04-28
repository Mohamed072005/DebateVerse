<?php

namespace App\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $user, string $userName);
    public function getBySenderIdAndStatus(int $senderId, int $status);
    public function getByReceiverIdAndStatus(int $receiverId, int $status);
    public function getUserById(int $id);
    public function getUsersWithoutAuthenticatedUser();
    public function findUserByUserName(string $user_name);
    public function getAdminId();
    public function getAllUsers();
    public function updateUserStatus(int $status, User $user);
    public function changeUserRole(int $role, User $user);
    public function getUsersForStatistics();
    public function getAdminsForStatistics();
}
