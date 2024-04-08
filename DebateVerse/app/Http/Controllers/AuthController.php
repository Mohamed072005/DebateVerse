<?php

namespace App\Http\Controllers;

use App\Models\Gender;
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
        $gender = Gender::all();
        return view('auth.register', compact('gender'));
    }
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phoneNumber' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'gender_name' => ['required', 'in:1,2']
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
            'role_id' => 2,
            'gender_id' => $request->input('gender_name')
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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('to.login');
    }
}
