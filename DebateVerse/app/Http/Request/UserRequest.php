<?php

namespace App\Http\Request;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
class UserRequest
{
    public function validate(Request $request)
    {
             $request->validate([
                'first_name' => ['required', 'string', 'min:3'],
                'last_name' => ['required', 'string', 'min:3'],
                'user_name' => ['required', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
                'phoneNumber' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10']
            ]);
    }
}
