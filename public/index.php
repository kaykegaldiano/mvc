<?php

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

session_start();

if (!isset($_SESSION['logged']) && stripos($path, 'login') === false && $path !== '/signup' && $path !== '/save-user') {
    header('Location: /login', response_code: 302);
    die();
}

$controllerClass = $routes[$path];
$controller = new $controllerClass();
$controller->handle();
