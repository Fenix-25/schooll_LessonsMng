<?php

namespace App\Services;

class Image
{
	public string $fileName;
	public string $path;
	public string $defaultPath = "uploads/";
	public string $pathToFile;
	public string $tmp_name;

//робить тільки вигрузку файлу

	public static function isLink($key): bool
	{
		if (!empty($_POST[$key]) && !is_array($key)) {
			return true;
		}
		return false;
	}

	public function upload($file): false|string
	{
		$this->pathToFile = self::iconDefault($file['error']);
		$newPath = $this->defaultPath  . $this->fileName;
		if (!empty($this->path)) {
			if (move_uploaded_file($this->tmp_name,  $newPath)) {
				return $this->pathToFile = $newPath;
			}
		}
		http_response_code(500);
		Route::errorPage(500);
		return false;
	}

	private static function iconDefault($file): false|string
	{
		return !empty($file) ? "uploads/image-outline-filled.png" : false;
	}

	public function setFileName(string $fileName): void
	{
		$this->fileName = $fileName;
	}
	public function setTmpName(string $tpm_name): void
	{
		$this->tmp_name = $tpm_name;
	}
	public function setPathToFile(string $pathToFile): void
	{
		$this->pathToFile = $pathToFile;
	}
	public function setPath(string $path): void
	{
		if (is_dir($path)) {
			mkdir($path);
		}
		$this->path = $path;
	}
}