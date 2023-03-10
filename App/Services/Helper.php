<?php

namespace App\Services;

class Helper
{
    public static function getUrl(): string
    {
        $path = $_SERVER['REQUEST_URI'];
        $path = explode("?", $path);
        return $path[0];
    }
    public static function emptyFieldsErrorMsg(array $request, array $requiredFields): bool
    {
        $emptyFields = [];

        foreach ($requiredFields as $field) {
            if (empty($request[$field])) {
                $emptyFields[] = $field;
            }
        }

        if (!empty($emptyFields)) {
            foreach ($emptyFields as $field) {
                Notification::notification("Field '{$field}' is empty", field: $field);
            }
            return true;
        }
        return false;
    }


}