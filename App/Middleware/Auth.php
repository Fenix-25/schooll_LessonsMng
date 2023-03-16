<?php

namespace App\Middleware;

use App\Services\Redirect;
use App\Services\Session;

class Auth
{
	public static function handle()
	{
		if (Session::auth()){
			Redirect::redirect('/login');
		}
	}
}