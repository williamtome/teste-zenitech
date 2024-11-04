<?php

namespace Williamtome\App\Router;

use Williamtome\App\Http\Request;
use Williamtome\App\Http\Response;

class Router
{
    private static array $routes = [];

    protected static function add(string $uri, string $action, string $method = 'GET'): void
    {
        self::$routes[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => $method,
        ];
    }

    public static function get(string $uri, string $action): void
    {
        self::add($uri, $action);
    }

    public static function post(string $uri, string $action): void
    {
        self::add($uri, $action, 'POST');
    }

    public static function routes(): array
    {
        return self::$routes;
    }

    public static function dispatch()
    {
        $url = '/';
        isset($_SERVER['REQUEST_URI']) ? $url = $_SERVER['REQUEST_URI'] : $url;

        $prefixController = 'Williamtome\\App\\Controllers\\';

        $routeFound = false;

        foreach (self::routes() as $route) {

            $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $route['uri']) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routeFound = true;

                if ($route['method'] !== Request::method()) {
                    continue;
                }

                [$controller, $action] = explode('@', $route['action']);
                require_once __DIR__ . "/../Controllers/$controller.php";
                $controller = $prefixController . $controller;
                $instanceController = new $controller();
                $instanceController->$action(new Request, new Response, $matches);
            }
        }

        if (!$routeFound) {
            return 'Ooops! Página não encontrada';
        }
    }
}
