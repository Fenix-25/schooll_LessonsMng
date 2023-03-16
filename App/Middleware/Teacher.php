<?php

namespace App\Middleware;

use App\Controllers\User;
use App\Services\Notification;
use App\Services\Session;

class Teacher
{
	public static function handle()
	{
		if (User::session()['is_active'] == 0) {
			Notification::notification('You are not verified!');
			Session::logout();
		}
	}
}