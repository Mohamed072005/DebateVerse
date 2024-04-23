<?php

namespace App\Http\Controllers;

use App\Http\Request\MessageRequest;
use App\Models\User;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use App\serveces\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $userService;
    private $userRepository;
    protected $messageRepository;
    //
    public function __construct(UserRepository $userRepository, MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
        $this->userService = UserService::getInstance();
    }

    public function toContact()
    {
        $userAsSender = $this->userRepository->getBySenderIdAndStatus(Auth::id(), 1);
        $userAsReceiver = $this->userRepository->getByReceiverIdAndStatus(Auth::id(), 1);
        $users = $this->userService->getUsersWithoutAuthenticatedUser();
        return view('contact', compact('users', 'userAsSender', 'userAsReceiver'));
    }

    public function toChat(User $user)
    {
        $userId = $user->id;
        $messages = $this->messageRepository->getUserMessages($userId);
        $users = $this->userService->getUsersWithoutAuthenticatedUser();
        $user = $this->userRepository->getUserById($userId);
        return view('chat', compact('users', 'messages', 'user'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $messageRequest = MessageRequest::getInstance();
        $messageRequest->validateMessage($request);
        $this->messageRepository->storeMessage($user->id, $request->message);
        return redirect()->route('chat', $user->id);
    }
}
