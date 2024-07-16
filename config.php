
<?php


require "vendor/autoload.php";


// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$PUBG_API_KEY = $_SERVER['PUBG_API_KEY'] ?? null;

if (!$PUBG_API_KEY) {
    throw new Exception('No PUBG API key provided. Please add a PUBG_API_KEY to the .env file.');
}


$DB_URL = $_SERVER['DB_URL'] ?? null;
$DB_USER = $_SERVER['DB_USER'] ?? null;
$DB_PASSWORD = $_SERVER['DB_PWD'] ?? null;
$DB_HOST = $_SERVER['DB_HOST'] ?? null;
$DB_PORT = $_SERVER['DB_PORT'] ?? null;
$DB_NAME = $_SERVER['DB_NAME'] ?? null;

if (!$DB_URL) {
    throw new Exception('No database URL provided. Please add a DB_URL to the .env file.');
} else if (!$DB_USER) {
    throw new Exception('No database user provided. Please add a DB_USER to the .env file.');
} else if (!$DB_PASSWORD) {
    throw new Exception('No database password provided. Please add a DB_PWD to the .env file.');
} else if (!$DB_HOST) {
    throw new Exception('No database host provided. Please add a DB_HOST to the .env file.');
} else if (!$DB_PORT) {
    throw new Exception('No database port provided. Please add a DB_PORT to the .env file.');
} else if (!$DB_NAME) {
    throw new Exception('No database name provided. Please add a DB_NAME to the .env file.');
}


function dsn($DB_HOST, $DB_PORT, $DB_NAME)
{
    return "mysql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME}";
}

$dsn = dsn($DB_HOST, $DB_PORT, $DB_NAME);

$DB_CONFIG = [
    'dsn' => $dsn,
    'user' => $DB_USER,
    'password' => $DB_PASSWORD
];



