<?php

namespace App\Services;

class Session
{
    public static function logout()
    {
        unset($_SESSION['user']);
        Redirect::redirect('/login');
    }

    public static function auth(): bool
    {
        return isset($_SESSION['user']);
    }


}