<?php

namespace App\Controllers\Auth;

use App\Controllers\Admin;
use App\Controllers\Director;
use App\Controllers\Student;
use App\Controllers\Teacher;
use App\Controllers\User;
use App\Services\Helper;
use App\Services\Notification;
use App\Services\Redirect;

class Login
{
    public static function login($request): void
    {
        unset($_SESSION['user']);
        $email = $request['email'];
        $password = $request['password'];
        $fields = ['email', 'password'];
        if (Helper::emptyFieldsErrorMsg($request, $fields)) {
            Redirect::redirect('/login');
        }
        Redirect::rdtWithCondition(!User::getUserEmail($email),'User not found!', '/login');
        Redirect::rdtWithCondition(!self::passwordCheck($password, $email), 'Credentials not found!', '/login');
        $user = $_SESSION['user'] = User::getUserByEmail($email);
        $userName = $user['name'];
        Notification::notification('Welcome ' . $userName, 'success');
        match ($user['role']){
          'student' => Student::login(),
          'teacher' => Teacher::login($request),
          'director' => Director::login($request),
          'admin' => Admin::login($request),
        };
    }

    private static function passwordCheck(string $password, string $userEmail): bool
    {
        return password_verify($password, User::getUserByEmail($userEmail)['password']);
    }
}