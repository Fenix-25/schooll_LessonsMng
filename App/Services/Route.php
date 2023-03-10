<?php

namespace App\Services;

class Route
{
    private static array $routes = [];


    public static function page($uri, $path): void
    {
        self:: $routes[] = [
            "uri" => $uri,
            "path" => $path
        ];
    }

    public static function post($uri, $class, $method, $formData = false, $files = false): void
    {
        self::$routes[] = [
            'uri' => $uri,
            'class' => $class,
            'method' => $method,
            'post' => true,
            'formData' => $formData,
            'files' => $files,
        ];
    }

    public static function run(): void
    {
        $uri = Helper::getUrl();
        foreach (self::$routes as $route) {
            if ($route['uri'] == $uri) {
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    $data = [
                        $route['class'],
                        $route['method']
                    ];
                    self::action($data, $route['formData'], $route['files']);
                } else {
                    require_once "views/" . $route['path'] . ".php";
                }
                exit();
            }
        }
        self::errorPage(404);
    }

    private static function action($data, $fD, $f): void
    {
        //оголошуємо створення нового об*єкту
        $action = new $data[0];
        $method = $data[1];
        if ($fD && $f) {
            $action->$method($_POST, $_FILES);
            exit();
        }
        if ($fD) {
            $action->$method($_POST);
            exit();
        }
        //викликаємо метод в оголошеного об*єкту
        $action->$method();
    }

    public static function errorPage($code): void
    {
        require_once "views/errors/" . $code . ".php";
        http_response_code($code);
    }

}