<?php

// Start session
session_start();

// Define base path
define("BASE_PATH", __DIR__);
require BASE_PATH . '/functions.php';

// Error reporting
// En production, désactiver l'affichage des erreurs
$isProd = getenv('KUBERNETES_SERVICE_HOST') !== false || getenv('APP_ENV') === 'production';
if ($isProd) {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
} else {
    // En développement, afficher les erreurs
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}


// Router setup
$method = $_POST["_method"] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($uri, PHP_URL_PATH);
require base_path('/src/router/router.php');


// View setup
$isLogged = isLogged();
$heading = "RiosApp";
require view("index", ["heading" => $heading, "isLogged" => $isLogged]);
