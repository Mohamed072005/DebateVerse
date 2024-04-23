<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    public function getBySenderIdAndStatus(int $senderId, int $status);
    public function getByReceiverIdAndStatus(int $receiverId, int $status);
    public function getUserById(int $id);
}
