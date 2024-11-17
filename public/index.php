<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

echo "Requested URI: " . $uri;

// Check if the route exists
if (isset($routes[$uri])) {
    $controllerName = $routes[$uri]['controller'];
    $methodName = $routes[$uri]['method'];

    // Instantiate the controller and call the method
    $controller = new $controllerName();
    $controller->$methodName();
} else {
    http_response_code(404);
    echo "404 Not Found";
}