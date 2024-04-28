<?php

namespace App\Repository;

use App\Models\Notification;

interface NotificationRepositoryInterface
{
    public function createNotificationForMessage(int $userId);
    public function deleteAllUserNotifications(int $userId);
    public function deleteUserNotification(Notification $notification);
}
