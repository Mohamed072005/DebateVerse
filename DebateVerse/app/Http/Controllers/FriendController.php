<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use App\serveces\FriendRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    private $friendRequestService;

    public function __construct(FriendRequestService $friendRequestService){
        $this->friendRequestService = $friendRequestService;
    }
    public function store(Request $request, User $user)
    {
        $token = null;
        if ($request->token){
            $token = $request->token;
        }
        $return = $this->friendRequestService->createRequestFriend($token, $user);

        if ($return['status'] == false){
            if ($return['user_id'] == null){
                return redirect()->route($return['route'])->with('errorProfile', $return['message']);
            }

            if ($return['user_id'] != null){
//                dd($return['user_id']);
                return redirect()->route($return['route'], $return['user_id'])->with('errorProfile', $return['message']);
            }
        }

        if ($return['user_id'] == null){

            return redirect()->route($return['route'])->with('successResponse', $return['message']);
        }


        return redirect()->route($return['route'], $return['user_id'])->with('successResponse', $return['message']);
    }

    public function acceptRequest(User $user)
    {
        $friend = Friend::where('sender_id', $user->id)->where('receiver_id', Auth::id())->first();
        $friend->status = 1;
        $friend->save();
        return redirect()->route('home')->with('successResponse', 'Friend request accepted Successfully');
    }

    public function removeFriend(User $user)
    {
        dd($user);
    }
}
