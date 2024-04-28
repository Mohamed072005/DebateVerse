<?php

namespace App\Http\Controllers;

use App\Http\Request\UserRequest;
use App\Models\Categorie;
use App\Models\Debate;
use App\Models\Tag;
use App\Models\User;
use App\Repository\UserRepository;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function toUsers()
    {
        $users = $this->userRepository->getAllUsers();
        return view('admin.users', compact('users'));
    }

    public function index()
    {
        $debates = Debate::where('user_id', Auth::id())->get();
        $tags = Tag::all();
        return view('layout-profile.profile', compact( 'tags', 'debates'));
    }

    public function friendProfile($user_id)
    {
        $user = User::where('id', $user_id)->first([
            'user_name',
            'id',
            'gender_id',
            'first_name',
            'last_name',
            'role_id'
        ]);

        if ($user){
            return view('layout-profile.usersProfile', compact('user'));
        }else {
            return redirect()->route('home')->with('errorProfile', 'This User does not fund');
        }
    }

    public function update(Request $request, UserRequest $userRequest)
    {
        $userRequest->validate($request);

        $user = User::find(Auth::id());
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->phone_number = $request->phoneNumber;
        $user->save();

        return redirect()->route('profile')->with('successResponse', 'Your Info Changed Successfully');

    }

    public function findUser(Request $request)
    {
        $user_name = $request->input('user_name');
        if ($user_name == ''){
            $users = $this->userRepository->getUsersWithoutAuthenticatedUser();
            return view('searchView', compact('users'));
        }
        $users = $this->userRepository->findUserByUserName($user_name);
        return view('searchView', compact('users'));
    }

    public function usersBan(User $user)
    {
        if ($user->status == 1){
            $this->userRepository->updateUserStatus(0, $user);
            return redirect()->route('users')->with('successResponse', 'User Banned Successfully');
        }
        $this->userRepository->updateUserStatus(1, $user);
        return redirect()->route('users')->with('successResponse', 'User UnBanned Successfully');
    }

    public function changeRole(User $user)
    {
        if ($user->role_id == 2){
            $this->userRepository->changeUserRole(3, $user);
            return redirect()->route('users')->with('successResponse', 'User Role Changed Successfully');
        }
        $this->userRepository->changeUserRole(2, $user);
        return redirect()->route('users')->with('successResponse', 'User Role Changed Successfully');
    }
}
