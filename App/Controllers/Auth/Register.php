<?php

namespace App\Controllers\Auth;

use App\Controllers\User;
use App\Services\DB;
use App\Services\Helper;
use App\Services\Notification;
use App\Services\Redirect;
use App\Services\Route;

class Register
{
    public static function register($request, $file): void
    {
        $fields = ['name', 'email', 'password', 'passwordConfirm'];
        if (Helper::emptyFieldsErrorMsg($request, $fields)) {
            Redirect::redirect('/register');
        }
        self::duplicateEmail($request['email']);
        self::password($request['password'], $request['passwordConfirm']);
        $avatar = self::uploadAvatar($file['avatar']);
        $insert = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT),
            'avatar' => $avatar,
        ];
        unset($request);
        DB::insert('users', $insert);
        Notification::notification('You are successfully registered', 'success');
        Redirect::redirect('/login');

    }

    private static function uploadAvatar($file): false|string
    {
        if (!empty($file['error'])) {
            return "uploads/image-outline-filled.png";
        }
        $fileName = time() . "_" . $file['name'];
        $path = "uploads/" . $fileName;
        if (move_uploaded_file($file['tmp_name'], $path)) {
            return $path;
        }
        http_response_code(500);
        Route::errorPage(500);
        return false;
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

    private static function duplicateEmail(string $email): void
    {
        Redirect::rdtWithCondition(User::getUserEmail($email)['email'] === $email, 'Email is taken', '/register');
    }
}