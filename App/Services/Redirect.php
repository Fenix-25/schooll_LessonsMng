<?php

namespace App\Services;

class Redirect
{
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