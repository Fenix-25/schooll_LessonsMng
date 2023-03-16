<?php

namespace App\Controllers;

use App\Services\DB;
use App\Services\Roles;

class User
{
	public static function getByEmail($email)
	{
		foreach (Roles::cases() as $class) {
			$query = (new DB)->where("email = '$email'")
				->select($class->name . "s")
				->get();
			if (!empty($query)) {
				return $query;
			}
		}
	}

	public static function getEmail($email)
	{
		foreach (Roles::cases() as $class) {
			$query = (new DB)->where("email = '$email'")
				->select($class->name . "s", 'email')
				->get();
			if (!empty($query)) {
				return $query['email'];
			}
		}

	}

	public static function avatar($key)
	{
		return self::session()[$key];
	}

	public static function session()
	{
		if (!empty($_SESSION['user']))
			return $_SESSION['user'];
	}

	public static function noActive($status)
	{
		if (!$status) {
			return "text-danger";
		}
		return "text-white";
	}


}