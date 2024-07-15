<?php

use Router\Router;

const BASE_PATH = __DIR__;

require BASE_PATH . '/functions.php';

$heading = "RiosApp";

require view("index", ["heading" => $heading]);


// spl_autoload_register(function ($class) {
//     require base_path("/src/core/{$class}.php");
// });

require base_path('/src/router/Router.php');
$router = new Router();

require base_path('/src/router/routes.php');


$method = $_POST["_method"] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->route(
    $uri,
    $method
);
