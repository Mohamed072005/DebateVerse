<?php

namespace App\Repository;

interface MessageRepositoryInterface
{
    public function getUserMessages(int $userId);
    public function storeMessage(int $messageId, string $message);
}
