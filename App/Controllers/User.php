<?php

namespace App\Controllers;

use App\Services\DB;

class User
{
    public static function getUserByEmail($email)
    {
        return DB::select('users', '*', "email = '$email' ", true);
    }

    public static function getUserEmail($email)
    {
        return DB::select('users', 'email', "email = '$email' ", true);
    }

    public static function user()
    {
        return $_SESSION['user'];
    }

}