<?php

namespace App\Middleware;

use Exception;

class Middleware
{
	const MAP = [
		'auth' => Auth::class,
		'student' => Student::class,
		'teacher' => Teacher::class,
		'director' => Director::class,
	];

	public static function resolve($key): void
	{
		if (!$key){
			return;
		}
		$middleware = static::MAP[$key] ?? false;
		if(!$middleware){
			throw new Exception("Not found middleware");
		}
		(new $middleware)->handle();
	}

}