<?php

namespace App\Kernel\Router;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(
        private View $view,
        private Request $request
    )
    {
        $this->setRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route){
            echo '404';
            exit();
        }

        if (is_array($route->getAction())) {
            $controller = $route->getAction()[0];

            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);

            call_user_func([$controller, $route->getAction()[1]]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private function getRoutes(): array
    {
        return require_once APP_PATH . "/config/routes.php";
    }

    private function setRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }
}