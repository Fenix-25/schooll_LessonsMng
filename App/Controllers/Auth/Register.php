<?php

namespace App\Controllers\Auth;

use App\Controllers\User;
use App\Services\DB;
use App\Services\Helper;
use App\Services\Image;
use App\Services\Notification;
use App\Services\Redirect;
use App\Services\Route;

class Register
{
	public static function register($request): void
	{
		$file = $_FILES;
		$_SESSION['user_tmp'] = array_merge( $_POST, $_FILES);
		$fields = ['name', 'email', 'class', 'birthday', 'password', 'passwordConfirm'];
		if (Helper::emptyFieldsErrorMsg($request, $fields)) {
			Redirect::redirect('/register');
		}
		self::duplicateEmail($request['email']);
		self::password($request['password'], $request['passwordConfirm']);
		$avatar = self::uploadAvatar($file['avatar']);
		$fullName = explode(" ", $request['name']);
		$insert = [
			'first_name' => $fullName[0],
			'name' => $fullName[1],
			'surname' => $fullName[2],
			'login' => $request['login'],
			'email' => $request['email'],
			'class' => $request['class'],
			'birthday' => $request['birthday'],
			'password' => password_hash($request['password'], PASSWORD_BCRYPT),
			'avatar' => $avatar,
		];
		unset($request);
		unset($_SESSION['user_tmp']);
		(new DB())->insert('users', $insert);
		Notification::notification('You are successfully registered', 'success');
		Redirect::redirect('/login');

	}

	private static function duplicateEmail(string $email): void
	{
		Redirect::rdtWithCondition(User::getEmail($email) === $email, 'Email is taken', '/register');
	}

	public static function password($password, $confirm): bool
	{
		if ($password !== $confirm) {
			Notification::notification("Passwords don't match");
			Redirect::redirect('/register');
			return false;
		}
		return true;
	}

	private static function uploadAvatar($icon): string
	{
		$image = new Image();
		if (empty($icon['error'])){
			$name = time() . "_" . $icon['name'];
			$image->setFileName($name);
			$image->setTmpName($icon['tmp_name']);
			$image-> defaultPath = ('uploads/');
			$image-> setPath('avatars/');
			$image->upload($icon);
		}
		return $image->pathToFile;
	}

	public function index()
	{
		return Helper::view('auth/register');
	}
}