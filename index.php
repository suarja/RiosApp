<?php


use Router\Router;

define('BASE_PATH', __DIR__);

error_reporting(E_ALL);
ini_set('display_errors', 1);

require BASE_PATH . '/functions.php';


$heading = "RiosApp";

require view("index", ["heading" => $heading]);



spl_autoload_register(function ($class) {
    $path = BASE_PATH . '/src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require $path;
    } else {
        error_log("Class file not found: $path");  // Log error for debugging
    }
});




$router = new Router();

require base_path('/src/router/routes.php');


$method = $_POST["_method"] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->route(
    $uri,
    $method
);
