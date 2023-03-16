<?php

namespace App\Services;

class Session
{
    public static function logout(): void
    {
        unset($_SESSION['user']);
        Redirect::redirect('/login');
    }

    public static function auth(): bool
    {
        return isset($_SESSION['user']);
    }

	public static function tmp(string $key, $avatar = false)
	{
		if(Image::isLink($key) && $avatar){
			$_SESSION['user_tmp'][$key] = $_POST[$key];
		}
		return !empty($_SESSION['user_tmp']) ? $_SESSION['user_tmp'][$key] : "";
	}


}