<?php

namespace App\serveces;

interface UserServiceInterface
{
    public function getUsersWithoutAuthenticatedUser();
}
