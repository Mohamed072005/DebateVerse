<?php

namespace App\Repository;

use App\Models\Notification;
use App\Repository\NotificationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function createNotificationForMessage(int $userId)
    {
        // TODO: Implement createNotificationForMessage() method.
        Notification::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $userId,
            'message' => 'has send you a message',
        ]);
    }

    public function deleteUserNotification(Notification $notification)
    {
        // TODO: Implement deleteUserNotification() method.
        $notification->delete();
    }

    public function deleteAllUserNotifications(int $userId)
    {
        // TODO: Implement deleteAllUserNotifications() method.
        $notifications = Notification::where('to_user_id', $userId)
            ->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
    }
}
