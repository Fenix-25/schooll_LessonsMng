<?php

namespace App\Middleware;

use App\Controllers\User;
use App\Services\Notification;
use App\Services\Redirect;
use App\Services\Roles;
use App\Services\Session;

class Student
{
	public static function handle()
	{
		if (User::session()['is_active'] == 0){
			Notification::notification('You are not verified!');
			Session::logout();
		}

	}

}