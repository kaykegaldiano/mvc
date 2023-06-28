<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['PATH_INFO'] ?? '/';
$routes = require __DIR__ . '/../config/routes.php';

if ($path === '/') {
    header('Location: /login');
    die();
}

if (!isset($routes[$path])) {
    http_response_code(404);
    die();
}

$controllerClass = $routes[$path];
$controller = new $controllerClass();
$controller->handle();
