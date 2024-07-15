<?php

const BASE_PATH = __DIR__;

require BASE_PATH . '/functions.php';

$heading = "RiosApp";

require view("index", ["heading" => $heading]);

require base_path('/src/router/router.php');

// spl_autoload_register(function ($class) {
//     require base_path("/src/core/{$class}.php");
// });
