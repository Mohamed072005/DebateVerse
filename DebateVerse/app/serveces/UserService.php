<?php

namespace App\serveces;

use App\Models\User;
use App\serveces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    private static $instance = null;

    private function __construct(){}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    public function getUsersWithoutAuthenticatedUser()
    {
        // TODO: Implement getUsersWithoutAuthenticatedUser() method.
        $users = User::where('id', '!=', Auth::id())->get([
            'user_name',
            'id',
            'gender_id'
        ]);
        return $users;
    }
}
