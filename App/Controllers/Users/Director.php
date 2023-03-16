<?php

namespace App\Controllers\Users;

use App\Services\DB;
use App\Services\Helper;
use App\Services\Redirect;

class Director
{
	public static function index()
	{
		return Helper::view('pages/director/index');
	}

	public static function login(): void
	{
		Redirect::redirect('/director-dashboard');
	}
}