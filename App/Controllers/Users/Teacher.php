<?php

namespace App\Controllers\Users;

use App\Services\DB;
use App\Services\Helper;
use App\Services\Redirect;

class Teacher
{

    public static function index()
    {
        return Helper::view('pages/teacher-dashboard');
    }
    public static function login(): void
    {
        Redirect::redirect('/teacher-dashboard');
    }

	public static function classTeacher($class): void
	{
		$query = "select * from students left join class_teacher on students.id = class_teacher.id";
		$class = new DB();
		$class = $class->raw($query)->all();
		d($class);
	}
}