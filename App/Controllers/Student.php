<?php

namespace App\Controllers;

use App\Services\Redirect;

class Student
{
    public static function store($request)
    {
        dd($request);
    }

    public static function login()
    {
        //Redirect::redirect('/student-dashboard');
    }
}