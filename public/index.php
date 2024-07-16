<?php

define('BASE_PATH', __DIR__ . '/../');

error_reporting(E_ALL);
ini_set('display_errors', 1);

require BASE_PATH . '/functions.php';

$heading = "RiosApp";

require view("index", ["heading" => $heading]);

spl_autoload_register(function ($class) {
    $class =  str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class = base_path("/src/{$class}.php");
    if (file_exists($class)) {
        require $class;
    } else {
        echo "Class not found";
        echo $class;
    }
});


$router = new Router\Router();

require base_path('/src/router/routes.php');

$method = $_POST["_method"] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->route(
    $uri,
    $method
);
