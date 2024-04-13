<?php

// Define routes
$routes = [
    '/' => 'DashboardController@index',
    '/interface' => 'InterfaceController@index',
    '/configure' => 'ConfigureController@index'
    // Add more routes here as needed
];

// Get the current URL path
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Match the URL path to a route
$route = rtrim($request_uri, '/') ?: '/';

// Check if the route exists
if (array_key_exists($route, $routes)) {
    // Extract the controller and method from the route definition
    [$controllerName, $methodName] = explode('@', $routes[$route]);
    
    // Include the controller file
    require_once __DIR__ . '/backend/controllers/' . $controllerName . '.php';
    
    // Instantiate the controller
    $controller = new $controllerName();
    
    // Call the method
    $controller->$methodName();
} else {
    // Route not found, return 404 error
    http_response_code(404);
    echo '404 Page Not Found';
}
