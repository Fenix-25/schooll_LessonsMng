<?php

namespace App\Services;

class Notification
{
    public static function notification($msg, $style = 'danger', $field = []): void
    {
        if (empty($field)) {
            $_SESSION['notify']['info']= compact('msg', 'style');
        } else {
            $_SESSION['notify']['error'][$field] = compact('msg', 'style');
        }

    }
}