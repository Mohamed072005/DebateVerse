<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Repository\NotificationRepository;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    private $notificationRepository;
    public function __construct(NotificationRepository $notificationRepository){
        $this->notificationRepository = $notificationRepository;
    }
    //
    public function destroyNotification(Notification $notification)
    {
        $this->notificationRepository->deleteUserNotification($notification);
        return redirect()->route('home');
    }

    public function destroyNotifications()
    {
        $userId = Auth::id();
        $this->notificationRepository->deleteAllUserNotifications($userId);
        return redirect()->route('home');
    }
}
