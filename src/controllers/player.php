

<?php


require "./data/player-1.php";
require "./src/functions.php";
require "./data/seasons-list.php";
require "./config.php";

$heading = "Player Stats";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerName = $_POST['playerName'];
    $playerOne = getPlayer($playerName, $PUBG_API_KEY);
    $playerSeasonStats = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);

    require "./views/player.view.php";
} else {
    require "./views/partials/player-form.php";
}
