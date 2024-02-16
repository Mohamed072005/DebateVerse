<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'user_name' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'phone_number' => ['required']
        ]);

        $register = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            "phone_number" => $request->input('phone_number'),
        ]);

        if($register){
            return response()->json('add success');
        }
        
    }

    public function getUsers(Request $request){
        // $users = User::get(['id', 'user_name', 'email', 'phone_number', 'password']);
        $user = $request->only('email', 'password');

        if(Auth::attempt($user)){
            return response()->json('login success');
        }else{
            return response()->json('login false');
        }
        
    }

    public function deleteUser($id){

        $deleteUser = User::find($id);
        $deleteUser->delete();

        if($deleteUser){
            return response()->json('delete success');
        }
    }


    public function updateUser(Request $request, $id){

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

        if($updateUser){
            return response()->json('update success');
        }else{
            return response()->json('No update');
        }
    }
}
