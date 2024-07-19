<?php

require "vendor/autoload.php";

// Check if running in a Kubernetes environment
$isProd = getenv('KUBERNETES_SERVICE_HOST') !== false;

if ($isProd) {
    // Production: Load environment variables directly from the environment
    $PUBG_API_KEY = getenv('PUBG_API_KEY');
    $DB_URL = getenv('DB_URL');
    $DB_USER = getenv('DB_USER');
    $DB_PASSWORD = getenv('DB_PASSWORD');
    $DB_HOST = getenv('DB_HOST');
    $DB_PORT = getenv('DB_PORT');
    $DB_NAME = getenv('DB_NAME');
} else {
    // Development: Load from .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    $PUBG_API_KEY = $_SERVER['PUBG_API_KEY'] ?? null;
    $DB_URL = $_SERVER['DB_URL'] ?? null;
    $DB_USER = $_SERVER['DB_USER'] ?? null;
    $DB_PASSWORD = $_SERVER['DB_PASSWORD'] ?? null;
    $DB_HOST = $_SERVER['DB_HOST'] ?? null;
    $DB_PORT = $_SERVER['DB_PORT'] ?? null;
    $DB_NAME = $_SERVER['DB_NAME'] ?? null;
}

// Exception handling for missing variables
if (!$PUBG_API_KEY) {
    throw new Exception('No PUBG API key provided.');
}
if (!$DB_URL || !$DB_USER || !$DB_PASSWORD || !$DB_HOST || !$DB_PORT || !$DB_NAME) {
    throw new Exception('Database configuration is incomplete.');
}

$dsn = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";
$DB_CONFIG = [
    'dsn' => $dsn,
    'user' => $DB_USER,
    'password' => $DB_PASSWORD
];
