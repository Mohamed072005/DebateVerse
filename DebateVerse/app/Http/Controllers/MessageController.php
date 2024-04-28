<?php

namespace App\Http\Controllers;

use App\Http\Request\MessageRequest;
use App\Models\User;
use App\Repository\MessageRepositoryInterface;
use App\Repository\NotificationRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $userRepository;
    private $messageRepository;
    private $notificationRepository;
    //
    public function __construct(UserRepositoryInterface $userRepository, MessageRepositoryInterface $messageRepository, NotificationRepositoryInterface $notificationRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function toContact()
    {
        $userAsSender = $this->userRepository->getBySenderIdAndStatus(Auth::id(), 1);
        $userAsReceiver = $this->userRepository->getByReceiverIdAndStatus(Auth::id(), 1);
        $users = $this->userRepository->getUsersWithoutAuthenticatedUser();
        return view('contact', compact('users', 'userAsSender', 'userAsReceiver'));
    }

    public function toChat(User $user)
    {
        $userId = $user->id;
        $messages = $this->messageRepository->getUserMessages($userId);
        $users = $this->userRepository->getUsersWithoutAuthenticatedUser();
        $user = $this->userRepository->getUserById($userId);
        return view('chat', compact('users', 'messages', 'user'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $messageRequest = MessageRequest::getInstance();
        $messageRequest->validateMessage($request);
        $this->messageRepository->storeMessage($user->id, $request->message);
        $this->notificationRepository->createNotificationForMessage($user->id);
        return redirect()->route('chat', $user->id);
    }
}
