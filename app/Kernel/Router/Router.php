<?php

namespace APP\Kernel\Router;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct()
    {
        $this->init();
    }

    public function dispatch(string $uri, string $method)
    {
        $route = $this->findRoute($uri, $method);
        if (! $route) {
            $this->routeNotFound();
        }

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();
            $controller = new $controller;
            call_user_func([$controller, $action]);
        } else {
            $route->getAction()();
        }
    }

    private function routeNotFound(): void
    {
        echo '404 | Not Found';
        exit();
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    private function init()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * @return Route[]
     */
    private function getRoutes()
    {
        return require_once APP_PATH . '/config/routes.php';
    }
}