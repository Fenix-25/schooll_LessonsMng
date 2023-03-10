<?php

namespace App\Services;

class Redirect
{
    public static string $refer;

    public function __construct()
    {
        return self::$refer = $_SERVER['HTTP_REFERER'];
    }

    public static function rdtWithCondition($condition, $msg, $path = "/"): void
    {
        if ($condition) {
            Notification::notification($msg);
            self::redirect($path);
        }
    }

    public static function redirect($path = "/")
    {
        header("Location:  $path");
        exit();
    }
}