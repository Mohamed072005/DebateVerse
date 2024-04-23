<?php

namespace App\Repository;

use App\Models\Message;
use App\Repository\MessageRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class MessageRepository implements MessageRepositoryInterface
{

    public function getUserMessages($userId)
    {
        // TODO: Implement getUserMessages() method.
        $messages = Message::where('sender_id', Auth::id())
            ->where('receiver_id', $userId)
            ->orWhere('receiver_id', Auth::id())
            ->where('sender_id', $userId)
            ->orderBy('created_at')
            ->get();

        return $messages;
    }

    public function storeMessage(int $messageId, string $message)
    {
        // TODO: Implement storeMessage() method.
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $messageId,
            'message' => $message
        ]);
    }
}
