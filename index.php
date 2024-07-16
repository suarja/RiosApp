<?php


const BASE_PATH = __DIR__;

require BASE_PATH . '/functions.php';

$heading = "RiosApp";

require view("index", ["heading" => $heading]);


spl_autoload_register(function ($class) {
    $path = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

// Set up the autoloader
spl_autoload_register(function ($class) {
    require BASE_PATH . '/src/' . str_replace('\\', '/', $class) . '.php';
});


$router = new Router\Router();

require base_path('/src/router/routes.php');


$method = $_POST["_method"] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->route(
    $uri,
    $method
);
