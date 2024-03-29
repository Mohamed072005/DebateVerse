<?php

namespace App\Http\Controllers;

use App\Http\Request\UserRequest;
use App\Models\Categorie;
use App\Models\Debate;
use App\Models\Tag;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $debates = Debate::where('user_id', Auth::id())->get();
        $categories = Categorie::all();
        $tags = Tag::all();
        return view('layout-profile.profile', compact('categories', 'tags', 'debates'));
    }

    public function update(Request $request, UserRequest $userRequest)
    {
        $userRequest->validate($request);

        $user = User::find(Auth::id());
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->phone_number = $request->phoneNumber;
        $user->save();

        return redirect()->route('profile')->with('successResponse', 'Your Info Changed Successfully');

    }
}
