<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function toLogin()
    {
        return view('auth.login');
    }

    public function toRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phoneNumber' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10']
        ]);

        $data = $request->first_name . rand(pow(10, 8 - 1), pow(10, 8) -1);
//        dd($data);

        User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'user_name' => $data,
            'password' => Hash::make($request->input('password')),
            'phone_number' => $request->input('phoneNumber'),
        ]);

        return redirect()->route('to.login');
    }

    public function login(Request $request)
    {
        // $users = User::get(['id', 'user_name', 'email', 'phone_number', 'password']);
        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            Auth::user();
            return redirect()->route('home');
        } else {
            return redirect()->route('to.login')->with('loginError', 'Invalid Email or Password');
        }
    }

    public function deleteUser($id)
    {

        $deleteUser = User::find($id);
        $deleteUser->delete();

        if ($deleteUser) {
            return response()->json('delete success');
        }
    }


    public function updateUser(Request $request, $id)
    {

        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'user_name' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'phone_number' => ['required']
        ]);

        $updateUser = User::find($id);
        $updateUser->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            "phone_number" => $request->input('phone_number'),
        ]);

        if ($updateUser) {
            return response()->json('update success');
        } else {
            return response()->json('No update');
        }
    }

    public function get()
    {
        $user = User::all();
        return response()->json($user);
    }
}
