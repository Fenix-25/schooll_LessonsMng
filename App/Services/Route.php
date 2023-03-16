<?php

namespace App\Services;

use App\Middleware\Middleware;

class Route
{
	public array $routes = [];

	public function get($uri, $controller, $method): Route
	{
		$this->add("GET", $uri, $controller, $method);
		return $this;
	}

	public function add($request_method, $uri, $controller, $method): void
	{
		$this->routes[] = [
			'uri' => $uri,
			'controller' => $controller,
			'method' => $method,
			'request_method' => $request_method,
		];
	}

	public function post($uri, $controller, $method): Route
	{
		$this->add("POST", $uri, $controller, $method);
		return $this;
	}

	public function files($uri, $controller, $method): Route
	{
		$this->add("FILES", $uri, $controller, $method);
		return $this;
	}

	public function delete($uri, $controller, $method): Route
	{
		$this->add("DELETE", $uri, $controller, $method);
		return $this;
	}

	public function put($uri, $controller, $method): Route
	{
		$this->add("PUT", $uri, $controller, $method);
		return $this;
	}

	public function page($uri, $path): Route
	{
		$this->routes[] = [
			"uri" => $uri,
			"path" => $path,
			"middleware" => null
		];
		return $this;
	}

	public function run(): void
	{
		$value = require_once('App/Services/Globals.php');
		$uri = Helper::getUrl();
		$request_method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
		$request_method = strtoupper($request_method);
		foreach ($this->routes as $route) {
			if ($route['uri'] == $uri && $request_method === $route['request_method']) {
				if (!empty($route['middleware'])){
					Middleware::resolve($route['middleware']);
				}
				$method = $route['method'];
				$action = new $route['controller'];
				$action->$method($value[$request_method]);
				exit();
			}
		}
		self::errorPage(404);
	}

	public static function errorPage($code): void
	{
		require_once "views/errors/" . $code . ".php";
		http_response_code($code);
	}

	public function only($key): static
	{
		$this->routes[array_key_last($this->routes)]['middleware'] = $key;
		return $this;
	}

}