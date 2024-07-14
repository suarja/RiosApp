

<?php


require "./data/player-1.php";
require "./src/functions.php";
require "./data/seasons-list.php";
require "./config.php";
$playerSeasonStats = getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY);

require "views/player.view.php";
?>