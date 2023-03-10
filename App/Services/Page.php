<?php

namespace App\Services;

class Page
{
    public static function part($name, $data = []): void
    {
        extract($data);
        require_once "views/parts/{$name}.php";
    }
}