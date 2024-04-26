<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    public function register(array $user, string $userName);
    public function getBySenderIdAndStatus(int $senderId, int $status);
    public function getByReceiverIdAndStatus(int $receiverId, int $status);
    public function getUserById(int $id);
    public function getUsersWithoutAuthenticatedUser();
    public function findUserByUserName(string $user_name);
}
