<?php

namespace App\Controllers\Auth;

use App\Controllers\Users\Director;
use App\Controllers\Users\Student;
use App\Controllers\Users\Teacher;
use App\Services\Helper;
use App\Services\Notification;
use App\Services\Redirect;
use App\Controllers\User;
use App\Services\Roles;
use Couchbase\Role;

class Login
{
    public static function index()
    {
        return Helper::view('auth/login');
    }
    public static function login($request): void
    {
        unset($_SESSION['user']);
        $email = $request['email'];
        $password = $request['password'];
        $fields = ['email', 'password'];
        if (Helper::emptyFieldsErrorMsg($request, $fields)) {
            Redirect::redirect('/login');
        }
        Redirect::rdtWithCondition(!User::getEmail($email),'User not found!', '/login');
        Redirect::rdtWithCondition(!self::passwordCheck($password, $email), 'Credentials not found!', '/login');
        $user = $_SESSION['user'] = User::getByEmail($email);
        $userName = $user['name'];
        Notification::notification('Welcome ' . $userName, 'success');
        match ($user['role']){
          Roles::student->name=> Student::login(),
          Roles::teacher->name => Teacher::login(),
          Roles::director->name => Director::login(),
//          Roles::admin->name => Admin::login(),
        };
    }

    private static function passwordCheck(string $password, string $userEmail): bool
    {
        return password_verify($password, User::getByEmail($userEmail)['password']);
    }
}