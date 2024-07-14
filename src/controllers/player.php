

<?php


require "./data/player-1.php";
require "./src/functions.php";
require "./data/seasons-list.php";
require "./config.php";
require_once './src/Database.php';

$heading = "Player Stats";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerName = $_POST['playerName'];
    // Check if the player name is empty
    if (empty($playerName)) {
        $error = "Please enter a player name";
        require "./views/partials/player-form.php";
        exit;
    }
    // check in the database if the player exists
    $isPlayerInDatabase = $db->isPlayerInDatabaseFromName($playerName);
    if ($isPlayerInDatabase) {
        $playerOne = $db->getPlayerFromName($playerName);
        $playerOne = Player::fromDB($playerOne);
        $playerSeasonStats
            = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);
        require "./views/player.view.php";
        exit;
    } else {
        $playerOne = getPlayer($playerName, $PUBG_API_KEY);
        $db->insertPlayer($playerOne);
        $playerSeasonStats = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);
        require "./views/player.view.php";
        exit;
    }
} else {
    require "./views/partials/player-form.php";
}
