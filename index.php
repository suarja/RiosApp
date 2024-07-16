<?php

// Start session
session_start();

// Define base path
define("BASE_PATH", __DIR__);
require BASE_PATH . '/functions.php';

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Router setup
$method = $_POST["_method"] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($uri, PHP_URL_PATH);
require base_path('/src/router/router.php');


// View setup
$heading = "RiosApp";
require view("index", ["heading" => $heading]);