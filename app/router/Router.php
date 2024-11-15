<?php

declare(strict_types=1);

namespace App\Router;

use App\Response\Response;

class Router
{
    private array $routes;
    private string $method;
    private string $uri;
    private Response $response;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->response = new Response();
    }

    public function run(): void
    {
        foreach ($this->routes as $pattern => $route) {
            if ($this->method === $route['method'] && preg_match("#^$pattern$#", $this->uri, $matches)) {
                $params = array_filter(
                    $matches,
                    fn($key) => !is_int($key),
                    ARRAY_FILTER_USE_KEY
                );
                $this->getController($route, $params);
                return;
            }
        }
        $this->response->view('error',['message' => 'Route not found'] ,404);
    }

    public function getController(array $route, array $params): void
    {
        $controllerClass = 'App\\Controllers\\' . $route['controller'] . 'Controller';

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass($this->response);
            $action = $route['action'];
            $controller->$action(...$params);
        } else {
            $this->response->view('error', ['message' =>'Controller not found'], 404);
        }
    }
}
