<?php


require base_path("/src/data/player-1.php");
require base_path("/src/data/seasons-list.php");
require base_path("/config.php");

$heading = "Player Stats";

// Load the database
require base_path("/src/core/App.php");
$db = App::resolve('db');

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerName = $_POST['playerName'];
    // Check if the player name is empty
    if (empty($playerName)) {
        $error = "Please enter a player name";
        require base_path("/views/partials/player-form.php");
        exit;
    }
    // check in the database if the player exists
    $isPlayerInDatabase = $db->isPlayerInDatabaseFromName($playerName);
    if ($isPlayerInDatabase) {
        $playerOne = $db->getPlayerFromName($playerName);
        $playerOne = Player::fromDB($playerOne);
        $playerSeasonStats
            = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);
        require view("players/player", ["playerOne" => $playerOne, "playerSeasonStats" => $playerSeasonStats, "heading" => $heading]);
        exit;
    } else {
        $player = getPlayer($playerName, $PUBG_API_KEY);
        if (!$player) {
            $errors[] = "Player not found";

            $playerSeasonStats = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);
            require view("players/player", ["playerOne" => $playerOne, "playerSeasonStats" => $playerSeasonStats, "heading" => $heading, "errors" => $errors]);
            exit;
        }
        $db->insertPlayer($playerOne);
        $playerSeasonStats = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);
        require view("players/player", ["playerOne" => $playerOne, "playerSeasonStats" => $playerSeasonStats, "heading" => $heading, "errors" => $errors]);
        exit;
    }
} else {
    $playerSeasonStats = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);
    if (!$playerSeasonStats) {
        $errors[] = "Player not found";
        require view("players/player", ["playerOne" => $playerOne, "playerSeasonStats" => $playerSeasonStats, "heading" => $heading, "errors" => $errors]);
        exit;
    }
    return require view("players/player", ["playerOne" => $playerOne, "playerSeasonStats" => $playerSeasonStats, "heading" => $heading, "errors" => $errors]);
}
