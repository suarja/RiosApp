
<?php


require "vendor/autoload.php";

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$PUBG_API_KEY = $_SERVER['PUBG_API_KEY'] ?? null;

if (!$PUBG_API_KEY) {
    throw new Exception('No PUBG API key provided. Please add a PUBG_API_KEY to the .env file.');
}
