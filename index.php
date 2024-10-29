<?php

declare(strict_types=1);

require 'vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/' => ['controller' => 'Home', 'action' => 'index'],
    '/about' => ['controller' => 'About', 'action' => 'index'],
    '/contact' => ['controller' => 'Contact', 'action' => 'index'],
    '/product/(?P<id>\d+)' => ['controller' => 'Product', 'action' => 'show'],
];

$routeFlag = false;
$params = [];

foreach ($routes as $pattern => $route)
{
    if (preg_match("#^$pattern$#", $uri, $matches))
    {
        $routeFlag = true;
        $params = array_filter(
            $matches,
            function ($key)
             {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_KEY
        );
        break;
    }
}

if ($routeFlag)
{
    $controllerClass = 'App\\Controllers\\' . $route['controller'] . 'Controller';

    if (class_exists($controllerClass))
    {
        $controller = new $controllerClass();
        $action = $route['action'];
        $controller->$action(...$params);
    } else
    {
        echo 'Controller not found';
    }
} else
{
    echo 'Route not found';
}
