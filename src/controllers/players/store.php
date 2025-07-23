<?php

$isLogged = isLogged();
$heading = "Create Player";

// Load the database
require base_path("/config.php");
require base_path('/src/core/Database.php');
require base_path('/data-classes/index.php');

require base_path("/src/core/App.php");
$db = App::resolve('db');

$errors = [];
$playerName = $_POST['playerName'];
// Check if the player name is empty
if (empty($playerName)) {
    $errors[] = "Please enter a player name";
    require view('players/player-form', compact('heading', 'errors', 'isLogged'));
    exit;
}
// check in the database if the player exists
$isPlayerInDatabase = $db->isPlayerInDatabaseFromName($playerName);
if ($isPlayerInDatabase) {
    $errors[] = "Player already exists";
    require view('players/player-form', compact('heading', 'errors', 'isLogged'));
    exit;
} else {
    $player = getPlayer($playerName, $PUBG_API_KEY);
    if (!$player) {
        $errors[] = "Player not found";
        require view('players/player-form', compact('heading', 'errors', 'isLogged'));
        exit;
    }
    $db->insertPlayer($player);

    //* Add the stats to DB
    // $playerSeasonStats = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);
    // $db->insertPlayerSeasonStats($playerOne, $playerSeasonStats);

    //? Consider redirect to the player page
    // require view('players/player', compact('heading', 'playerOne', 'playerSeasonStats'));

    redirect("/players");
    exit;
}

//hmidoulye