<?php

namespace App\Services;

use App\Controllers\User;

class Page
{
    public static function part($name, $data = []): void
    {
        extract($data);
        require_once "views/parts/{$name}.php";
    }

    public static function link()
    {
        if (!empty(User::session())) {
            return match (User::session()['role']) {
                Roles::student->name => "/student-dashboard",
                Roles::teacher->name => "/teacher-dashboard",
                Roles::director->name => "/director-dashboard",
            };
        }
    }
	public static function active($url): string
	{
        if ($url == Helper::getUrl()) {
            return "active";
        }
		return "";
    }
}