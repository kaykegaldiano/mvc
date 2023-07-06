<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

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

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$controllerClass = $routes[$path];
/** @var ContainerInterface */
$container = require __DIR__ . '/../config/dependencies.php';
/** @var RequestHandlerInterface $controller */
$controller = $container->get($controllerClass);
$response = $controller->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
