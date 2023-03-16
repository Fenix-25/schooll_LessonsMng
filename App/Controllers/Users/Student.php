<?php

namespace App\Controllers\Users;

use App\Controllers\User;
use App\Services\DB;
use App\Services\Helper;
use App\Services\Redirect;

class Student
{
	public static function index()
	{
		return Helper::view('pages/student/index');
	}

	public static function login(): void
	{
		Redirect::redirect('/student-dashboard');
	}
	public function myClass()
	{
		$class = User::session()['class'];
		$class = (new DB)->select('students')->all();
		dd($class);

		return  Helper::view('pages/my_class', ['class' => $class]);
	}
}