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


    public function toFriends()
    {
        $userAsSender = Friend::where('sender_id', Auth::id())->where('status', 1)->get();
        $userAsReceiver = Friend::where('receiver_id', Auth::id())->where('status', 1)->get();
        $users = User::where('id', '!=', Auth::id())->get([
            'user_name',
            'id',
            'gender_id'
        ]);
        return view('friends', compact('userAsSender', 'userAsReceiver', 'users'));
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

            return redirect()->route($return['route'], $return['user_id'])->with('errorProfile', $return['message']);
        }

        if ($return['user_id'] == null){

            return redirect()->route($return['route'])->with('successResponse', $return['message']);
        }


        return redirect()->route($return['route'], $return['user_id'])->with('successResponse', $return['message']);
    }

    public function acceptRequest(Request $request, User $user)
    {
        $friend = Friend::where('sender_id', $user->id)->where('receiver_id', Auth::id())->first();
        $friend->status = 1;
        $friend->save();
        if ($request->token){
            return redirect()->route('home')->with('successResponse', 'Friend request accepted Successfully');
        }
        return redirect()->route('friends')->with('successResponse', 'Friend request accepted Successfully');
    }

    public function rejectRequest(Request $request, User $user)
    {
        $friend = Friend::where('sender_id', $user->id)->where('receiver_id', Auth::id())->first();
        $friend->delete();
        if ($request->token){
            return redirect()->route('home')->with('successResponse', 'Friend request rejected Successfully');
        }
        return redirect()->route('friends')->with('successResponse', 'Friend request rejected Successfully');
    }

    public function removeFriend(Request $request, User $user)
    {
        $ifReceiver = null;
        if ($request->sender){
            $ifReceiver = 0;
        }
        if ($request->receiver){
            $ifReceiver = 1;
        }
        $return = $this->friendRequestService->removeFriend($ifReceiver, $user);
        if ($ifReceiver == null){
            return redirect()->route($return['route'], $user->id)->with('successResponse', $return['message']);
        }
        if ($return !== false){
            return redirect()->route($return['route'])->with('successResponse', $return['message']);
        }
        return redirect()->route('error404');
    }
}
