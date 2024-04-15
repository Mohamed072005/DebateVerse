<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    //
    public function store(User $user)
    {
        $senderExist = Friend::where('sender_id', $user->id)->first();
        if ($senderExist) {
            return redirect()->route('home')->with('errorProfile', 'You already send friend request');
        }
    }
}
