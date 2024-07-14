<?php


require "vendor/autoload.php";

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$PUBG_API_KEY = $_SERVER['PUBG_API_KEY'] ?? null;
if (!$PUBG_API_KEY) {
    throw new Exception('No PUBG API key provided. Please add a PUBG_API_KEY to the .env file.');
}

require "./data/player-1.php";
require "./data/seasons-list.php";
require './src/functions.php';

$heading = "RiosApp";
$rios = $playerOne;
$riosName = $rios->attributes->name;

// Init cURL session
$url = "https://api.pubg.com/shards/xbox/seasons/{$seasonId}/gameMode/squad/players?filter[playerIds]={$playerOne->id}";
$ch = curl_init($url);

// Set the HTTP headers and options
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/vnd.api+json',
    'Authorization: Bearer ' . $PUBG_API_KEY,
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$response = curl_exec($ch);
if ($response === false) {
    throw new Exception(curl_error($ch), curl_errno($ch));
}

$responseData = json_decode($response, true);
$playerSeasonStats = new PlayerSeason(json_encode($responseData));
$playerSeasonStats = $playerSeasonStats->data[0];
curl_close($ch);

// dd($playerSeasonStats);
require './views/index.view.php';
