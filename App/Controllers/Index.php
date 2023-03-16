<?php

namespace App\Controllers;

use App\Services\Helper;

class Index
{

    public static function index()
    {
        return Helper::view('pages/index');
    }
}