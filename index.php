<?php

declare(strict_types=1);

require 'vendor/autoload.php';
$routes = require 'app/routes.php';

$router = new \App\Router\Router($routes);
$router->route();
