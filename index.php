<?php

require_once 'config/routes.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the route exists
if (isset($routes[$uri])) {
    $controllerName = $routes[$uri]['controller'];
    $methodName = $routes[$uri]['method'];

    // Include the controller file
    require_once "app/controllers/$controllerName.php";

    // Instantiate the controller and call the method
    $controller = new $controllerName();
    $controller->$methodName();
} else {
    http_response_code(404);
    echo "404 Not Found";
}