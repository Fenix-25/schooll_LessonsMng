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

	public static function view(string $path, array $data = [])
	{
		extract($data);
		return require_once "views/" . $path . ".php";
	}

	public static function isChecked($value): string
	{
		if ($value){
			return "checked";
		}
		return "";
	}

	public static function showFormatDate($date, $format = "d.m.Y"): string
	{
		$time = strtotime($date);
		return date($format, $time);
	}


}